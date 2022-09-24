<?php

namespace TelegramPhp\Traits;

trait Command {

    public function matchCommand (string $command)
    {
        $match = $this->match ('/(?<command>^\/[^\s]+)\s?(?<complement>.+)?/', $command);

        if (empty ($match)) return [];

        $value_match = $match [0];

        return [
            'full' => $value_match [0],
            'command' => $value_match ['command'],
            'complement' => $value_match ['complement'] ?? null
        ];
    }
    
    public function isCommand (string $command)
    {
        $match = $this->matchCommand ($command);
        return isset ($match ['command']);
    }
    
    public function matchComplement (string|null $complement_route, string|null $complement_text)
    {
        if ($complement_route == '' || $complement_text == '') return [];

        $regex_route = '/\{\{([^\s]+)\}\}/';
        $regex_text = '/([^\s]+)/';
        $data = [];

        $keys = $this->match ($regex_route, $complement_route);
        $values = $this->match ($regex_text, $complement_text);

        // clean
        // unset ($values [0]);

        foreach ($keys as $index => $key){
            if (!isset ($values [$index][1])) continue;
            $data [$key [1]] = $values [$index][1];
        }

        return $data;
    }

    function match (string $regex, string $str, $reduce = false)
    {
        $is_match = (bool)preg_match_all ($regex, $str, $match, PREG_SET_ORDER);
        if ($is_match){
            if ($reduce){
                return $this->reduceValuesMatch ($match);
            }
            return $match;
        } 
        return [];
    }

    /**
     * Reduz lista de match removendo valores repetidos
     * 
     * @param array $values
     * 
     * @return array
     */
    public function reduceValuesMatch (array $values)
    {
        $data = [];
        foreach ($values as $index => $value) {
            foreach ($value as $i => $v) {
                if (!in_array($v, $data)) {
                    $data [] = $v;
                }
            }
        }
        return $data;
    }

}