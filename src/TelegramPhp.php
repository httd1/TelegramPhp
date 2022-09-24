<?php

namespace TelegramPhp;

use \TelegramPhp\Config\Token;
use \TelegramPhp\Request\Request;

/**
 * Package for Telegram Bot API in php, TelegramPhp
 * 
 * @author JM (t.me/httd1)
 */
class TelegramPhp {

    use \TelegramPhp\Traits\Command;

    /**
     * @var string
     */
    private $token;
    
    /**
     * @var array
     */
    public $content;

    function __construct ()
    {
        $this->token = Token::$token;
        $this->initContent ();
    }

    /**
     * @return void
     */
    public function initContent () :void
    {
        $content = file_get_contents ('php://input');
        $this->content = json_decode ($content, true);
    }

    /**
     * Execute a callback to a command.
     * 
     * @param string $route
     * @param $action
     * 
     * @return void
     */
    public function command (string $route, $action) :void
    {
        // é um comando ex: /comando, podemos processar
        if ($this->isCommand ($this->getText ())){
            // separa $route em full, command, complement
            $route_command = $this->matchCommand ($route);
            // separa comando do usário em full, command, complement
            $text_command = $this->matchCommand ($this->getText ());
            
            $data = $this->matchComplement ($route_command ['complement'], $text_command ['complement']);

            if (count (explode (' ', $route_command ['complement'] ?? '')) == count (explode (' ', $text_command ['complement'] ?? ''))){
                // /comando é o mesmo em $this->getText () e $route
                if ($route_command ['command'] == $text_command ['command']){
                    $this->runAction ($action, $data);
                }
            }
        }else {
            // é uma mensagem normal, compara com o route
            if ($this->getText () == $route){
                $this->runAction ($action, []);
            }
        }
    }

    /**
     * Executes a regular expression on a text sent to the bot.
     * 
     * @param string $regex
     * @param $action
     * 
     * @return void
     */
    public function commandMatch (string $regex, $action) :void
    {
        $match = $this->match ($regex, $this->getText (), true);

        if (!empty ($match))
        {
            $this->runAction ($action, $match);
        }
    }

    /**
     * @param $action
     * @param array $data
     */
    function runAction ($action, array $data = [])
    {
        $action ($this, $data);
    }

    /**
     * @param string $content
     * 
     * @return void
     */
    public function setContent (string $content) :void
    {
        $this->content = json_decode ($content, true);
    }

    /**
     * Content of update received.
     * 
     * @return array
     */
    public function getContent () :array
    {
        return $this->content;
    }

    /**
     * At most one of these https://core.telegram.org/bots/api#update optional parameters can be present in any update.
     * 
     * @return string
     */
    public function getUpdateType () :string
    {
            $keys = array_keys ($this->content);
            return $keys [1];
    }

    /**
     * For text messages, the actual UTF-8 text of the message.
     * 
     * @return string
     */
    public function getText () :string
    {
        if ($this->getUpdateType () == 'edited_message'){
            return $this->content ['edited_message']['text'];
        }
        if ($this->getUpdateType () == 'channel_post'){
            return $this->content ['channel_post']['text'];
        }
        if ($this->getUpdateType () == 'edited_channel_post'){
            return $this->content ['edited_channel_post']['text'];
        }
        if ($this->getUpdateType () == 'inline_query'){
            return $this->content ['inline_query']['query'];
        }
        if ($this->getUpdateType () == 'chosen_inline_result'){
            return $this->content ['chosen_inline_result']['query'];
        }
        if ($this->getUpdateType () == 'callback_query'){
            return $this->content ['callback_query']['data'];
        }
        return $this->content ['message']['text'] ?? '';
    }
   
    /**
     * Unique identifier for a user or bot.
     * This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it.
     * 
     * @return string
     */
    public function getUserId () :string
    {
        // if ($this->getUpdateType () == 'edited_message'){
        //     return $this->content ['edited_message']['from']['id'];
        // }
        // if ($this->getUpdateType () == 'channel_post'){
        //     return $this->content ['channel_post']['from']['id'];
        // }
        // if ($this->getUpdateType () == 'edited_channel_post'){
        //     return $this->content ['edited_channel_post']['from']['id'];
        // }
        // if ($this->getUpdateType () == 'inline_query'){
        //     return $this->content ['inline_query']['from']['id'];
        // }
        // if ($this->getUpdateType () == 'chosen_inline_result'){
        //     return $this->content ['chosen_inline_result']['from']['id'];
        // }
        // if ($this->getUpdateType () == 'callback_query'){
        //     return $this->content ['callback_query']['from']['id'];
        // }
        // if ($this->getUpdateType () == 'shipping_query'){
        //     return $this->content ['shipping_query']['from']['id'];
        // }
        // if ($this->getUpdateType () == 'pre_checkout_query'){
        //     return $this->content ['pre_checkout_query']['from']['id'];
        // }
        // if ($this->getUpdateType () == 'my_chat_member' || $this->getUpdateType () == 'chat_member'){
        //     return $this->content ['my_chat_member']['from']['id'];
        // }
        // if ($this->getUpdateType () == 'chat_join_request'){
        //     return $this->content ['chat_join_request']['from']['id'];
        // }
        // return $this->content ['message']['from']['id'];
        return $this->content [$this->getUpdateType ()]['from']['id'];
    }

    /**
     * [IETF language tag](https://en.wikipedia.org/wiki/IETF_language_tag) of the user's language
     * 
     * @return string
     */
    public function getLanguageCode () :string
    {
        return $this->content [$this->getUpdateType ()]['from']['id'] ?? 'en';
    }

    /**
     * User's or bot's first name
     * 
     * @return string
     */
    public function getFirstName () :string
    {
        return $this->content [$this->getUpdateType ()]['from']['first_name'];
    }
    
    /**
     * User's or bot's last name
     * 
     * @return string|null
     */
    public function getLastName () :string|null
    {
        return $this->content [$this->getUpdateType ()]['from']['last_name'] ?? null;
    }
    
    /**
     * User's or bot's full name
     * 
     * @return string
     */
    public function getFullName () :string
    {
        return $this->getFirstName ()." ".$this->getLastName ();
    }
    
    /**
     * User's or bot's username
     * 
     * @return string|null
     */
    public function getUsername () :string|null
    {
        return $this->content [$this->getUpdateType ()]['from']['username'] ?? null;
    }
    
    /**
     * True, if this user is a Telegram Premium user.
     * 
     * @return bool
     */
    public function isPremium () :bool
    {
        return $this->content [$this->getUpdateType ()]['from']['is_premium'] ?? false;
    }

    /**
     * Unique message identifier inside a chat.
     * 
     * @return string
     */
    public function getMessageId () :string
    {
        if ($this->getUpdateType () == 'edited_message'){
            return $this->content ['edited_message']['message_id'];
        }
        if ($this->getUpdateType () == 'channel_post'){
            return $this->content ['channel_post']['message_id'];
        }
        if ($this->getUpdateType () == 'edited_channel_post'){
            return $this->content ['edited_channel_post']['message_id'];
        }
        if ($this->getUpdateType () == 'callback_query'){
            return $this->content ['callback_query']['message']['message_id'];
        }
        return $this->content ['message']['message_id'];
    }
    
    /**
     * Unique identifier for a chat.
     * This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it.
     * 
     * @return string
     */
    public function getChatId () :string
    {
        if ($this->getUpdateType () == 'edited_message'){
            return $this->content ['edited_message']['chat']['id'];
        }
        if ($this->getUpdateType () == 'channel_post'){
            return $this->content ['channel_post']['chat']['id'];
        }
        if ($this->getUpdateType () == 'edited_channel_post'){
            return $this->content ['edited_channel_post']['chat']['id'];
        }
        if ($this->getUpdateType () == 'callback_query'){
            return $this->content ['callback_query']['message']['chat']['id'];
        }
        if ($this->getUpdateType () == 'my_chat_member'){
            return $this->content ['my_chat_member']['chat']['id'];
        }
        if ($this->getUpdateType () == 'chat_member'){
            return $this->content ['chat_member']['chat']['id'];
        }
        if ($this->getUpdateType () == 'chat_join_request'){
            return $this->content ['chat_join_request']['chat']['id'];
        }
        return $this->content ['message']['chat']['id'];
    }

    /**
     * Update media type, possible values, photo, animation, audio, document, sticker, video, video_note,
     * voice, contact, dice, game, poll, venue, location, invoice.
     * 
     * @return string|null
     */
    public function getMediaType () :string|null
    {
        if (isset ($this->getContent ()[$this->getUpdateType ()]['photo'])){
            return 'photo';
        }
        if (isset ($this->getContent ()[$this->getUpdateType ()]['animation'])){
            return 'animation';
        }
        if (isset ($this->getContent ()[$this->getUpdateType ()]['audio'])){
            return 'audio';
        }
        if (isset ($this->getContent ()[$this->getUpdateType ()]['document'])){
            return 'document';
        }
        if (isset ($this->getContent ()[$this->getUpdateType ()]['sticker'])){
            return 'sticker';
        }
        if (isset ($this->getContent ()[$this->getUpdateType ()]['video'])){
            return 'video';
        }
        if (isset ($this->getContent ()[$this->getUpdateType ()]['video_note'])){
            return 'video_note';
        }
        if (isset ($this->getContent ()[$this->getUpdateType ()]['voice'])){
            return 'voice';
        }
        if (isset ($this->getContent ()[$this->getUpdateType ()]['contact'])){
            return 'contact';
        }
        if (isset ($this->getContent ()[$this->getUpdateType ()]['dice'])){
            return 'dice';
        }
        if (isset ($this->getContent ()[$this->getUpdateType ()]['game'])){
            return 'game';
        }
        if (isset ($this->getContent ()[$this->getUpdateType ()]['poll'])){
            return 'poll';
        }
        if (isset ($this->getContent ()[$this->getUpdateType ()]['venue'])){
            return 'venue';
        }
        if (isset ($this->getContent ()[$this->getUpdateType ()]['location'])){
            return 'location';
        }
        if (isset ($this->getContent ()[$this->getUpdateType ()]['invoice'])){
            return 'invoice';
        }
        return null;
    }


    /**
     * Unique identifier for a query.
     * 
     * @return int|null
     */
    public function getCallbackQueryId () :string|null
    {
        return $this->content ['callback_query']['id'] ?? null;
    }

    /**
     * Type of chat, can be either “private”, “group”, “supergroup” or “channel”.
     * 
     * @return string
     */
    public function getChatType () :string
    {
        if ($this->getUpdateType () == 'inline_query'){
            return $this->content ['inline_query']['chat_type'];
        }
        if ($this->getUpdateType () == 'callback_query'){
            return $this->content ['callback_query']['message']['chat_type'];
        }
        if (isset ($this->content [$this->getUpdateType ()])){
            return $this->content [$this->getUpdateType ()]['chat']['type'];
        }
        return 'private';
    }

    /**
     * Save a file from getFile.
     * 
     * @param array $getFile Result of method getFile
     * @param string $dest File destination will be saved
     * 
     * @throws \Exception
     * 
     * @return bool
     */
    public function saveFile (array $getFile, string $dest) :bool
    {

        if (!isset ($getFile ['result']['file_path'])){
            throw new \Exception ('$getFile is required!');
        }

        $url_file = "https://api.telegram.org/file/bot".Token::$token."/".$getFile ['result']['file_path'];
        $fopen = fopen ($dest, 'wb');

        $curl = curl_init ($url_file);
        curl_setopt ($curl, CURLOPT_FILE, $fopen);
        $exec = curl_exec ($curl);
        curl_close ($curl);

        if ($exec === false){
            throw new \Exception (curl_error ($curl));
        }

        return true;
    }
    
}