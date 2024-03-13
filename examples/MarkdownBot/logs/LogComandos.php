<?php

use \TelegramPhp\Methods;

class LogComandos {

    // method log required
    public function log ($tlg, $action, $route, $data)
    {

        $log = "\n------- LOG ---------\n";
        $log .= "Text: {$tlg->getText()}\n";
        $log .= "Route: {$route}\n";
        $log .= "Action: {$action}\n";
        $log .= "Data: " . json_encode($data) . "\n";
        $log .= "Usuário: {$tlg->getFirstName()} - {$tlg->getUserId()}\n";
        
        Methods::sendMessage ([
            'chat_id' => '275123569',
            'text' => $log
        ]);

    }

}