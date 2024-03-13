<?php

namespace TelegramPhp;

class Reaction {

    /**
     * This object describes the type of a reaction.
     * 
     * @param array $reaction
     * 
     * @return string
     */
    public static function reactionType (array $reaction) :string
    {
        return \json_encode ($reaction);
    }

    /**
     * The reaction is based on an emoji.
     * 
     * @see https://core.telegram.org/bots/api#reactiontypeemoji
     * 
     * @param string $emoji
     * 
     * @return array
     */
    public static function reactionTypeEmoji (string $emoji) :array
    {
        return [
            'type' => 'emoji',
            'emoji' => $emoji
        ];
    }
    
    /**
     * The reaction is based on a custom emoji.
     * 
     * @see https://core.telegram.org/bots/api#reactiontypecustomemoji
     * 
     * @param string $custom_emoji_id
     * 
     * @return array
     */
    public static function reactionTypeCustomEmoji (string $custom_emoji_id) :array
    {
        return [
            'type' => 'custom_emoji',
            'custom_emoji_id' => $custom_emoji_id
        ];
    }

}