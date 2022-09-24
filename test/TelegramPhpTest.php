<?php

include __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use TelegramPhp\TelegramPhp;

class TelegramPhpTest extends TestCase {

    public function tlgUser ()
    {
        $tlg = new TelegramPhp ();
        $tlg->setContent ('{"update_id":264419866,"message":{"message_id":40270,"from":{"id":275123569,"is_bot":false,"first_name":"J.M","username":"httd1","language_code":"pt-br"},"chat":{"id":275123569,"first_name":"J.M","username":"httd1","type":"private"},"date":1663637938,"text":"\/start","entities":[{"offset":0,"length":6,"type":"bot_command"}]}}');
        return $tlg;
    }
    
    public function tlgChannelPost ()
    {
        $tlg = new TelegramPhp ();
        $tlg->setContent ('{"update_id": 298386797,"channel_post": {"message_id": 13,"sender_chat": {"id": -1001794755993,"title": "Canal Teste","type": "channel"},"chat": {"id": -1001794755993,"title": "Canal Teste","type": "channel"},"date": 1662127987,"text": "Tfhhgcfg","has_protected_content": true}}');
        return $tlg;
    }

    public function testGetters ()
    {
        $this->assertEquals (275123569, $this->tlgUser ()->getUserId (), "Erro, id de usuário é diferente");
        $this->assertEquals (275123569, $this->tlgUser ()->getChatId (), "Erro, id de Chat é diferente");
        $this->assertEquals ('J.M', $this->tlgUser ()->getFirstName (), "Erro, nome de usuário é diferente");
        $this->assertContains ('/start', [$this->tlgUser ()->getText ()], "Erro, texto de mensagem diferente");
    }
}