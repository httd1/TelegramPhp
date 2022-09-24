<?php

namespace TelegramPhp\Request;

use \TelegramPhp\Config\Token;

class Request {

    function __construct (){}

    const API_ENDPOINT = 'https://api.telegram.org/bot';

    public $default_method_request = 'POST';
    
    public function request ($method_api, $data = [])
    {
        if ($this->default_method_request == 'POST')
        {
            $link = self::API_ENDPOINT.Token::$token.'/'.$method_api;
        }else {
            $link = self::API_ENDPOINT.Token::$token.'/'.$method_api.'?'.http_build_query ($data);
        }

        $curl = curl_init ($link);
        curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt ($curl, CURLOPT_RETURNTRANSFER, true);

        if ($this->default_method_request == 'POST')
        {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt ($curl, CURLOPT_POSTFIELDS, $data);
        }

        $result = curl_exec ($curl);
        curl_close ($curl);

        if ($result === false)
        {
            throw new \Exception(curl_error ($curl));
        }

        $resultJson = json_decode ($result, true);

        // echo "Url: {$link}\n";
        // echo "Data: ".print_r ($data, true)."\n";
        // echo "Method: {$this->default_method_request}\n";
        // echo "========= RESPONSE =========\n";
        // echo "Response: {$result}\n";

        return $resultJson;
    }

    public function setMethodRequest ($method)
    {
        $this->default_method_request = $method;
    }
}