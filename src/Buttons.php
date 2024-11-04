<?php

namespace TelegramPhp;

class Buttons {

    /**
     * @see https://core.telegram.org/bots/api#inlinekeyboardmarkup
     * 
     * @param array $inline_keyboard
     * 
     * @return string
     */
    public static function inlineKeyBoard (array $inline_keyboard) :string
    {
        return json_encode ([
            'inline_keyboard' => $inline_keyboard
        ]);
    }

    /**
     * HTTP or tg:// URL to be opened when the button is pressed.
     * 
     * @param string $text
     * @param string $url
     * 
     * @return array
     */
    public static function inlineKeyBoardUrl (string $text, string $url) :array
    {
        return [
            'text' => $text,
            'url' => $url
        ];
    }

    /**
     * Data to be sent in a [callback query](https://core.telegram.org/bots/api#callbackquery) to the bot when button is pressed, 1-64 bytes.
     * 
     * @param string $text
     * @param array $callback_data
     * 
     * @return array
     */
    public static function inlineKeyBoardCallbackData (string $text, string $callback_data) :array
    {
        return [
            'text' => $text,
            'callback_data' => $callback_data
        ];
    }
    
    /**
     * Description of the [Web App](https://core.telegram.org/bots/webapps) that will be launched when the user presses the button.
     * 
     * @param string $text
     * @param string $url
     * 
     * @return array
     */
    public static function inlineKeyBoardWebApp (string $text, string $url) :array
    {
        return [
            'text' => $text,
            'web_app' => [
                'url' => $url
            ]
        ];
    }
    
    /**
     * An HTTPS URL used to automatically authorize the user. Can be used as a replacement for the [Telegram Login Widget](https://core.telegram.org/widgets/login).
     * 
     * @param string $text
     * @param string $url
     * @param string $forward_text
     * @param string $bot_username
     * @param bool $request_write_access
     * 
     * @return array
     */
    public static function inlineKeyBoardLoginUrl (string $text, string $url, string $forward_text = '', string $bot_username = '', bool $request_write_access = true) :array
    {
        return [
            'text' => $text,
            'login_url' => [
                'url' => $url,
                'forward_text' => $forward_text,
                'bot_username' => $bot_username,
                'request_write_access' => $request_write_access
            ]
        ];
    }
    
    /**
     * If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot's username and the specified inline query in the input field.
     * May be empty, in which case just the bot's username will be inserted.
     * 
     * @param string $text
     * @param string $switch_inline_query
     * 
     * @return array
     */
    public static function inlineKeyBoardSwitchInlineQuery (string $text, string $switch_inline_query) :array
    {
        return [
            'text' => $text,
            'switch_inline_query' => $switch_inline_query
        ];
    }
    
    /**
     * Pressing the button will insert the bot's username and the specified inline query in the current chat's input field.
     * May be empty, in which case only the bot's username will be inserted.
     * 
     * @param string $text
     * @param string $switch_inline_query_current_chat
     * 
     * @return array
     */
    public static function inlineKeyBoardSwitchInlineQueryCurrentChat (string $text, string $switch_inline_query_current_chat) :array
    {
        return [
            'text' => $text,
            'switch_inline_query_current_chat' => $switch_inline_query_current_chat
        ];
    }

    /**
     * Pressing the button will prompt the user to select one of their chats of the specified type, open that chat and insert the bot's username and the specified inline query in the input field.
     * Not supported for messages sent on behalf of a Telegram Business account.
     * 
     * @param string $text
     * @param string $query
     * @param bool $allow_user_chats
     * @param bool $allow_bot_chats
     * @param bool $allow_group_chats
     * @param bool $allow_channel_chats
     * 
     * @return array
     */
    public static function inlineKeyBoardSwitchInlineQueryChosenChat (string $text, string $query = '', bool $allow_user_chats = true, bool $allow_bot_chats = true, bool $allow_group_chats = true, bool $allow_channel_chats = true) :array
    {
        return [
            'text' => $text,
            'switch_inline_query_chosen_chat' => [
                'query' => $query,
                'allow_user_chats' => $allow_user_chats,
                'allow_bot_chats' => $allow_bot_chats,
                'allow_group_chats' => $allow_group_chats,
                'allow_channel_chats' => $allow_channel_chats
            ]
        ];
    }

    /**
     * Description of the button that copies the specified text to the clipboard.
     * 
     * @param string $text
     * @param string $copy_text
     * 
     * @return array
     */
    public static function inlineKeyBoardCopyText (string $text, string $copy_text) :array
    {
        return [
            'text' => $text,
            'copy_text' => [
                'text' => $copy_text
            ]
        ];
    }
    
    /**
     * Specify True, to send a [Pay button](https://core.telegram.org/bots/api#payments).
     * - NOTE: This type of button must always be the first button in the first row and can only be used in invoice messages.
     * 
     * @param string $text
     * @param bool $pay
     * 
     * @return array
     */
    public static function inlineKeyBoardPay (string $text, bool $pay = true) :array
    {
        return [
            'text' => $text,
            'pay' => $pay
        ];
    }

    /**
     * @see https://core.telegram.org/bots#keyboards
     * 
     * @param array $keyboard
     * @param bool $resize_keyboard
     * @param bool $one_time_keyboard
     * @param string $input_field_placeholder
     * @param bool $selective
     * 
     * @return string
     */
    public static function replyKeyBoardMarkup (array $keyboard, bool $is_persistent = false, bool $resize_keyboard = false, bool $one_time_keyboard = false, string $input_field_placeholder = '', bool $selective = false) :string
    {
        return json_encode ([
            'keyboard' => $keyboard,
            'is_persistent' => $is_persistent,
            'resize_keyboard' => $resize_keyboard,
            'one_time_keyboard' => $one_time_keyboard,
            'input_field_placeholder' => $input_field_placeholder,
            'selective' => $selective
        ]);
    }

    /**
     * Text of the button
     * 
     * @param string $text
     * 
     * @return array
     */
    public static function keyBoardButtonText (string $text) :array
    {
        return [
            'text' => $text
        ];
    }

    /**
     * The user's phone number will be sent as a contact when the button is pressed.
     * Available in private chats only.
     * 
     * @param string $text
     * 
     * @return array
     */
    public static function keyBoardButtonRequestContact (string $text) :array
    {
        return [
            'text' => $text,
            'request_contact' => true
        ];
    }

    /**
     * The user's current location will be sent when the button is pressed.
     * Available in private chats only.
     * 
     * @param string $text
     * 
     * @return array
     */
    public static function keyBoardButtonRequestLocation (string $text) :array
    {
        return [
            'text' => $text,
            'request_location' => true
        ];
    }

    /**
     * The user will be asked to create a poll and send it to the bot when the button is pressed.
     * Available in private chats only.
     * 
     * @param string $text
     * @param string $type
     * 
     * @return array
     */
    public static function keyBoardButtonRequestPoll (string $text, string $type) :array
    {
        return [
            'text' => $text,
            'request_poll' => [
                'type' => $type
            ]
        ];
    }

    /**
     * The described [Web App](https://core.telegram.org/bots/webapps) will be launched when the button is pressed.
     * The Web App will be able to send a “web_app_data” service message.
     * Available in private chats only.
     * 
     * @param string $text
     * @param string $url
     * 
     * @return array
     */
    public static function keyBoardButtonWebApp (string $text, string $url) :array
    {
        return [
            'text' => $text,
            'web_app' => [
                'url' => $url
            ]
        ];
    }

    /**
     * Defines the criteria used to request a suitable user.
     * The identifier of the selected user will be shared with the bot when the corresponding button is pressed.
     * [More about requesting users](https://core.telegram.org/bots/features#chat-and-user-selection)
     * 
     * @param string $text
     * @param int $request_id
     * @param bool|null $user_is_bot
     * @param bool|null $user_is_premium
     * @param int|null $max_quantity
     * @param bool|null $request_name
     * @param bool|null $request_username
     * @param bool|null $request_photo
     * 
     * @return array
     */
    public static function keyBoardButtonRequestUser (string $text, int $request_id, bool|null $user_is_bot = null, bool|null $user_is_premium = null, int|null $max_quantity = null, bool|null $request_name = null, bool|null $request_username = null, bool|null $request_photo = null) :array
    {
        $arrayKeyBoard = [
            'text' => $text,
            'request_users' => [
                'request_id' => $request_id,
                'max_quantity' => $max_quantity ?? 1
            ]
        ];

        if (!\is_null ($user_is_bot)){
            $arrayKeyBoard ['request_user']['user_is_bot'] = $user_is_bot;
        }
        
        if (!\is_null ($user_is_premium)){
            $arrayKeyBoard ['request_user']['user_is_premium'] = $user_is_premium;
        }

        if (!\is_null ($request_name)){
            $arrayKeyBoard ['request_user']['request_name'] = $request_name;
        }

        if (!\is_null ($request_username)){
            $arrayKeyBoard ['request_user']['request_username'] = $request_username;
        }

        if (!\is_null ($request_photo)){
            $arrayKeyBoard ['request_user']['request_photo'] = $request_photo;
        }

        return $arrayKeyBoard;
    }

    /**
     * Defines the criteria used to request a suitable chat.
     * The identifier of the selected chat will be shared with the bot when the corresponding button is pressed.
     * [More about requesting chats](https://core.telegram.org/bots/features#chat-and-user-selection)
     * 
     * @param string $text
     * @param int $request_id
     * @param bool $chat_is_channel
     * @param bool|null $chat_is_forum
     * @param bool|null $chat_has_username
     * @param bool|null $chat_is_created
     * @param array|null $user_administrator_rights
     * @param array|null $bot_administrator_rights
     * @param bool|null $bot_is_member
     * @param bool|null $request_title
     * @param bool|null $request_username
     * @param bool|null $request_photo
     * 
     * @return array
     */
    public static function keyBoardButtonRequestChat (string $text, int $request_id, bool $chat_is_channel = false, bool|null $chat_is_forum = null, bool|null $chat_has_username = null, bool|null $chat_is_created = null, array|null $user_administrator_rights = null, array|null $bot_administrator_rights = null, bool|null $bot_is_member = null, bool|null $request_title = null, bool|null $request_username = null, bool|null $request_photo = null) :array
    {

        $arrayKeyBoard = [
            'text' => $text,
            'request_chat' => [
                'request_id' => $request_id,
                'chat_is_channel' => $chat_is_channel,
            ]
        ];

        if (!\is_null ($chat_is_forum)){
            $arrayKeyBoard ['request_chat']['chat_is_forum'] = $chat_is_forum;
        }
        
        if (!\is_null ($chat_has_username)){
            $arrayKeyBoard ['request_chat']['chat_has_username'] = $chat_has_username;
        }
        
        if (!\is_null ($chat_is_created)){
            $arrayKeyBoard ['request_chat']['chat_is_created'] = $chat_is_created;
        }
        
        if (!\is_null ($user_administrator_rights)){
            $arrayKeyBoard ['request_chat']['user_administrator_rights'] = $user_administrator_rights;
        }
        
        if (!\is_null ($bot_administrator_rights)){
            $arrayKeyBoard ['request_chat']['bot_administrator_rights'] = $bot_administrator_rights;
        }
        
        if (!\is_null ($bot_is_member)){
            $arrayKeyBoard ['request_chat']['bot_is_member'] = $bot_is_member;
        }

        if (!\is_null ($request_title)){
            $arrayKeyBoard ['request_chat']['request_title'] = $request_title;
        }

        if (!\is_null ($request_username)){
            $arrayKeyBoard ['request_chat']['request_username'] = $request_username;
        }

        if (!\is_null ($request_photo)){
            $arrayKeyBoard ['request_chat']['request_photo'] = $request_photo;
        }

        return $arrayKeyBoard;
    }

    /**
     * Requests clients to remove the custom keyboard (user will not be able to summon this keyboard; if you want to hide the keyboard from sight but keep it accessible, use one_time_keyboard in [ReplyKeyboardMarkup](https://core.telegram.org/bots/api#replykeyboardmarkup)).
     * 
     * @see https://core.telegram.org/bots/api#replykeyboardremove
     * 
     * @param bool $selective
     * 
     * @return string
     */
    public static function replyKeyboardRemove (bool $selective = false) :string
    {
        return json_encode ([
            'remove_keyboard' => true,
            'selective' => $selective
        ]);
    }
    
    /**
     * Shows reply interface to the user, as if they manually selected the bot's message and tapped 'Reply'.
     * 
     * @see https://core.telegram.org/bots/api#forcereply
     * 
     * @param string $input_field_placeholder
     * @param bool $selective
     * 
     * @return string
     */
    public static function forceReply (string $input_field_placeholder = '', bool $selective = false) :string
    {
        return json_encode ([
            'force_reply' => true,
            'input_field_placeholder' => $input_field_placeholder,
            'selective' => $selective
        ]);
    }

}