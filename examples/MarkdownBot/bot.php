<?php

include __DIR__.'/../../vendor/autoload.php';
include __DIR__.'/logs/LogComandos.php';
include __DIR__.'/MarkdownBot.php';

use \TelegramPhp\TelegramPhp;

\TelegramPhp\Config\Token::setToken ('343008038:AAGIgeZ6jG6EDJwxU5Slu1KrC2LHxwe1Nlk');

$tlg = new TelegramPhp ();

\TelegramPhp\Config\Logs::catchLogs ([
    LogComandos::class,
]);

// debug
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
    "text":"/start",
    "entities":[
        {
            "offset":0,
            "length":6,
            "type":"bot_command"
        }
    ]
    }
}');

// get and process reactions
$tlg->on ('message_reaction', function ($bot){

    print_r ($bot->getContent ());

});

$tlg->command ('/start', 'MarkdownBot:start');
$tlg->command ('/help', 'MarkdownBot:help');
$tlg->commandMatch ('/^(?<texto>[^\/]+)/', 'MarkdownBot:markdownText');

$tlg->commandDefault ('MarkdownBot:defaultResponse');