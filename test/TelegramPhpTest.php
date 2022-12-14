<?php

include __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use TelegramPhp\TelegramPhp;

class TelegramPhpTest extends TestCase {
    
    public function tlgChannelPost ()
    {
        $tlg = new TelegramPhp ();
        $tlg->setContent ('{"update_id": 298386797,"channel_post": {"message_id": 13,"sender_chat": {"id": -1001794755993,"title": "Canal Teste","type": "channel"},"chat": {"id": -1001794755993,"title": "Canal Teste","type": "channel"},"date": 1662127987,"text": "Tfhhgcfg","has_protected_content": true}}');
        return $tlg;
    }

    public function testGetters ()
    {
        $tlg = new TelegramPhp ();
        $tlg->setContent ('{
        "update_id":264419866,
            "message":{
                "message_id":40270,
                    "from":{
                        "id":275123569,
                        "is_bot":false,
                        "first_name":"J.M",
                        "username":"httd1",
                        "language_code":"pt-br"
                    },
                    "chat":{
                        "id":275123569,
                        "first_name":"J.M",
                        "username":"httd1",
                        "type":"private"
                    },
                "date":1663637938,
                "text":"🔥 Hot"
            }
        }');

        $tlg->setSecretToken ('12345xyz');

        $this->assertEquals (275123569, $tlg->getUserId (), "Erro, id de usuário é diferente");
        $this->assertEquals (275123569, $tlg->getChatId (), "Erro, id de Chat é diferente");
        $this->assertEquals ('J.M', $tlg->getFirstName (), "Erro, nome de usuário é diferente");
        $this->assertContains ('🔥 Hot', [$tlg->getText ()], "Erro, texto de mensagem diferente");
        $this->assertEquals ('12345xyz', $tlg->getSecretToken (), "Erro, secret token inválido");
        $this->assertEquals ('pt-br', $tlg->getLanguageCode (), "Erro, valor de language_code inesperado");
    }

    public function testSecretToken ()
    {
        $tlg = new TelegramPhp;
        
        $_SERVER ['HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN'] = '12345xyz';
        $tlg->setSecretToken ('12345xyz');

        $this->assertTrue ($tlg->checkSecretToken ());
    }

    public function testCommand ()
    {

        $tlg = new TelegramPhp ();
        $tlg->setContent ('{
        "update_id":264419871,
            "message":{
                "message_id":40385,
                "from":{
                        "id":275123569,
                        "is_bot":false,
                        "first_name":"J.M",
                        "username":"httd1",
                        "language_code":"pt-br"
                    },
                "chat":{
                        "id":275123569,
                        "first_name":"J.M",
                        "username":"httd1",
                        "type":"private"
                    },
                "date":1665229721,
                "text":"\/category art 2",
                "entities":[
                    {
                        "offset":0,
                        "length":9,
                        "type":"bot_command"
                    }
                ]
            }
        }');

        $test = false;

        $tlg->command ('/category {{category}} {{page}}', function ($tlg, $data) use (&$test){
            if ($data ['category'] == 'art' && $data ['page'] == 2){
                $test = !$test;
            }
        });

        $this->assertTrue ($test);
    }

    public function testCommandMatch ()
    {
        $tlg = new TelegramPhp ();
        $tlg->setContent ('{
        "update_id":264419871,
            "message":{
                "message_id":40385,
                "from":{
                        "id":275123569,
                        "is_bot":false,
                        "first_name":"J.M",
                        "username":"httd1",
                        "language_code":"pt-br"
                    },
                "chat":{
                        "id":275123569,
                        "first_name":"J.M",
                        "username":"httd1",
                        "type":"private"
                    },
                "date":1665229721,
                "text":"\/category art 2",
                "entities":[
                    {
                        "offset":0,
                        "length":9,
                        "type":"bot_command"
                    }
                ]
            }
        }');

        $test = false;

        $tlg->commandMatch ('/^\/category (\w+) (\d+)$/', function ($bot, $data) use (&$test){
            if ($data [1] == 'art' && $data [2] == '2'){
                $test = !$test;
            }
        });

        $this->assertTrue ($test);
    }
}