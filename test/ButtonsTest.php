<?php

include __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use TelegramPhp\TelegramPhp;
use TelegramPhp\Buttons;

class ButtonsTest extends TestCase {

    public function testReplyKeyBoardMarkup ()
    {

        $textButton = [
            Buttons::keyBoardButtonText ('####')
        ];

        $replyKeyBoardMarkup = Buttons::replyKeyBoardMarkup ([$textButton]);

        $this->assertIsString ($replyKeyBoardMarkup);
        $this->assertSame (['text' => '####'], $textButton [0]);

    }
    
    public function testInlineKeyBoard ()
    {

        $urlButton = [
            Buttons::inlineKeyBoardUrl ('Test', 'https://t.me')
        ];

        $inlineKeyBoard = Buttons::inlineKeyBoard ([$urlButton]);

        $this->assertIsString ($inlineKeyBoard);
        $this->assertSame (['text' => 'Test', 'url' => 'https://t.me'], $urlButton [0]);

    }

}