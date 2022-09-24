<?php

include __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use \TelegramPhp\Config\Token;

class TokenTest extends TestCase {

    public function testTokenSetted ()
    {
        $token_bot = '110201543:AAHdqTcvCH1vGWJxfSeofSAs0K5PALDsaw';
        Token::setToken ($token_bot);
        $this->assertEquals ($token_bot, Token::$token);
    }

}