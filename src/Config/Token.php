<?php

namespace TelegramPhp\Config;

class Token {

    static $token;

    /**
     * The token is a string along the lines of ```110201543:AAHdqTcvCH1vGWJxfSeofSAs0K5PALDsaw``` that is required to authorize the bot and send requests to the [Bot API](https://core.telegram.org/bots/api).
     * 
     * @param string $bot_token
     * 
     * @return void
     */
    public static function setToken (string $bot_token)
    {
        if (is_null (self::$token))
        {
            self::$token = $bot_token;
        }
    }
}