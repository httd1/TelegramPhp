<?php

namespace TelegramPhp\Config;

class Logs {

    /**
     * @var array
     */
    static $logCommands = [];

   /**
    * Set the class to capture logs of commands.
    * **It's required that you define the _log_ method in your class.**
    *
    * @param array|string $class
    * 
    * @return void
    */
    static function catchLogs (string|array $class) :void
    {

        if (!\is_array ($class)){
            $class = [$class];
        }
        self::$logCommands = [...$class];

    }
}