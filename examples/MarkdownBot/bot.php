<?php

include __DIR__.'/../../vendor/autoload.php';
include __DIR__.'/MarkdownBot.php';

use \TelegramPhp\TelegramPhp;
use \TelegramPhp\Methods;
use \TelegramPhp\Buttons;

\TelegramPhp\Config\Token::setToken ('343008038:AAGIgeZ6jG6EDJwxU5Slu1KrC2LHxwe1Nlk');

$tlg = new TelegramPhp ();

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
    "text":"/start carro",
    "entities":[
        {
            "offset":0,
            "length":6,
            "type":"bot_command"
        }
    ]
    }
}');

$tlg->command ('/start {{teste}}', 'MarkdownBot:start');
$tlg->command ('/help', 'MarkdownBot:help');
$tlg->commandMatch ('/^[^\/]+/', 'MarkdownBot:markdownText');