<?php

namespace TelegramPhp;

use \TelegramPhp\Config\Token;
use \TelegramPhp\Config\Logs;

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
     * @var string
     */
    private $secret_token;
    
    /**
     * @var array
     */
    public $content;

    /**
     * @var bool
     */
    public $hasCommand = false;

    function __construct ()
    {

        if (!\version_compare (PHP_VERSION, 7.0, '>='))
        {
            throw new \Exception ('Unsupported version!');
        }

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
     * Command default executed when there aren't command defined.
     * 
     * @param callable|string $action
     * 
     * @return void
     */
    public function commandDefault (callable|string $action) :void
    {
        
        if ($this->hasCommand == false && !empty ($this->getText ())){
            $this->runAction ($action);
            $this->callLogs ($action, 'default', []);
        }

    }

    /**
     * Execute a callback to a command.
     * 
     * @param string $route
     * @param callable|string $action
     * 
     * @return void
     */
    public function command (string $route, callable|string $action) :void
    {

        if (empty ($route)){
            throw new \Exception ("Route cannot be empty!");
        }

        // se o texto e o route definido é um comando ex: /comando, podemos processar
        if (!empty ($this->getText ()) && $this->isCommand ($this->getText ()) && $this->isCommand ($route)){
            // separa $route em full, command, complement
            $route_command = $this->matchCommand ($route);
            // separa comando do usuário em full, command, complement
            $text_command = $this->matchCommand ($this->getText ());
            
            if ($this->complementEquals ($route_command ['complement'], $text_command ['complement'])){

                $data = $this->matchComplement ($route_command ['complement'], $text_command ['complement']);

                // /comando é o mesmo em $this->getText () e $route
                if ($route_command ['command'] == $text_command ['command']){
                    $this->runAction ($action, $data);
                    $this->callLogs ($action, $route, $data);

                    if ($this->hasCommand == false) $this->hasCommand = true;

                    return;
                }
            }
        }else {
            // é uma mensagem normal, compara com o route
            if ($this->getText () == $route){
                $this->runAction ($action, []);
                $this->callLogs ($action, $route, []);

                if ($this->hasCommand == false) $this->hasCommand = true;

                return;
            }
        }
    }

    /**
     * Executes a regular expression on a text sent to the bot.
     * 
     * @param string $regex
     * @param callable|string $action
     * 
     * @return void
     */
    public function commandMatch (string $regex, callable|string $action) :void
    {

        if (empty ($regex)){
            throw new \Exception ("Regex cannot be empty!");
        }

        if (!empty ($this->getText ())){

            $match = $this->match ($regex, $this->getText (), true);

            if (!empty ($match)){
                $this->runAction ($action, $match);
                $this->callLogs ($action, $regex, $match);

                if ($this->hasCommand == false) $this->hasCommand = true;

                return;
            }
        }
        
    }

    /**
     * Runs $action when an update sent by Telegram is the same of $updates.
     * 
     * @param string|array $updates
     * @param callable|string $action
     * 
     * @return void
     */
    public function on (string|array $updates, callable|string $action) : void
    {

        // convert to array
        if (!is_array ($updates)){
            $updates_list [] = $updates;
        }else {
            $updates_list = $updates;
        }

        if (in_array ($this->getUpdateType (), $updates_list)){
            $this->runAction ($action, []);
        }

    }

    /**
     * @param callable|string $action
     * @param array $data
     */
    function runAction (callable|string $action, array $data = []) :void
    {
        if (is_callable ($action)){
            $action ($this, $data);
        }else {
            list ($class, $method) = $this->match ('/[^:@]+/', $action, true);
            // classe existe!
            if (\class_exists ($class)){

                $obj = new $class;

                // método existe!
                if (\method_exists ($obj, $method)){
                    $obj->$method ($this, $data); //chama método
                }else {
                    throw new \Exception ("Method \"{$method}\" doesn't exist in '{$class}' class");
                }

            }else {
                throw new \Exception ("Class \"{$class}\" doesn't exist");
            }
        }

    }

    /**
     * Call log class
     * 
     * @param callable|string $action
     * @param string $route
     * @param array $data
     * 
     * @return void
     */
    public function callLogs (callable|string $action, string $route, array $data) :void
    {

        foreach (Logs::$logCommands as $log){
            $clssLog = new $log;
            $action = \is_callable ($action) ? 'function' : $action;
            $clssLog->log ($this, $action, $route, $data);
        }

    }

    /**
     * Verifies the secret token sent in an “X-Telegram-Bot-Api-Secret-Token” header on each webhook request, from 1 to 256 characters.
     * The header is useful to ensure that the request comes from a webhook you define.
     * 
     * @return bool
     */
    public function checkSecretToken () :bool
    {
        return ($this->getSecretTokenRequest () == $this->secret_token);
    }

    /**
     * Return the secret token from the webhook request
     * 
     * @return string
     */
    public function getSecretTokenRequest () :string
    {
        return $_SERVER ['HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN'] ?? '';
    }

    /**
     * Get secret token
     * 
     * @return string
     */
    public function getSecretToken () :string
    {
        return $this->secret_token;
    }

    /**
     * Set secret token used in webhook
     * 
     * @param string $secretToken
     * 
     * @return void
     */
    public function setSecretToken (string $secretToken) :void
    {
        $this->secret_token = $secretToken;
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
     * 
     * @throws \Exception
     */
    public function getUpdateType () :string
    {
            $keys = array_keys ($this->content);

            if (!isset ($keys [1])){
                throw new \Exception ("Invalid update");
            }

            return $keys [1];
    }

    /**
     * A point on the map, [see here the parameters](https://core.telegram.org/bots/api#location)
     * 
     * @return array|null
     */
    public function getLocation () :?array
    {
        return $this->content ['message']['location'] ?? [];
    }

    /**
     * For text messages, the actual UTF-8 text of the message.
     * 
     * @return string|null
     */
    public function getText () :?string
    {
        if ($this->getUpdateType () == 'edited_message' 
        && isset ($this->content['edited_message']['text'])){
            $text = $this->content ['edited_message']['text'];
        }
        if ($this->getUpdateType () == 'channel_post' 
        && isset ($this->content ['channel_post']['text'])){
            $text = $this->content ['channel_post']['text'];
        }
        if ($this->getUpdateType () == 'edited_channel_post' 
        && isset ($this->content ['edited_channel_post']['text'])){
            $text = $this->content ['edited_channel_post']['text'];
        }
        if ($this->getUpdateType () == 'business_message' 
        && isset ($this->content ['business_message']['text'])){
            $text = $this->content ['business_message']['text'];
        }
        if ($this->getUpdateType () == 'edited_business_message' 
        && isset ($this->content ['edited_business_message']['text'])){
            $text = $this->content ['edited_business_message']['text'];
        }
        if ($this->getUpdateType () == 'inline_query' 
        && isset ($this->content ['inline_query']['query'])){
            $text = $this->content ['inline_query']['query'];
        }
        if ($this->getUpdateType () == 'chosen_inline_result' 
        && isset ($this->content ['chosen_inline_result']['query'])){
            $text = $this->content ['chosen_inline_result']['query'];
        }
        if ($this->getUpdateType () == 'callback_query' 
        && isset ($this->content ['callback_query']['data'])){
            $text = $this->content ['callback_query']['data'];
        }

        return $text ?? $this->content ['message']['text'] ?? null;
    }
   
    /**
     * Unique identifier for a user or bot.
     * This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it.
     * 
     * @return int|null
     */
    public function getUserId () :?int
    {
        if ($this->getUpdateType () == 'edited_message' 
        && isset ($this->content ['edited_message']['from']['id'])){
            $user_id = $this->content ['edited_message']['from']['id'];
        }
        if ($this->getUpdateType () == 'channel_post' 
        && isset ($this->content ['channel_post']['from']['id'])){
            $user_id = $this->content ['channel_post']['from']['id'];
        }
        if ($this->getUpdateType () == 'edited_channel_post' 
        && isset ($this->content ['edited_channel_post']['from']['id'])){
            $user_id = $this->content ['edited_channel_post']['from']['id'];
        }
        if ($this->getUpdateType () == 'business_connection' 
        && isset ($this->content ['business_connection']['user']['id'])){
            $user_id = $this->content ['business_connection']['user']['id'];
        }
        if ($this->getUpdateType () == 'business_message' 
        && isset ($this->content ['business_message']['from']['id'])){
            $user_id = $this->content ['business_message']['from']['id'];
        }
        if ($this->getUpdateType () == 'edited_business_message' 
        && isset ($this->content ['edited_business_message']['from']['id'])){
            $user_id = $this->content ['edited_business_message']['from']['id'];
        }
        if ($this->getUpdateType () == 'inline_query' 
        && isset ($this->content ['inline_query']['from']['id'])){
            $user_id = $this->content ['inline_query']['from']['id'];
        }
        if ($this->getUpdateType () == 'chosen_inline_result' 
        && isset ($this->content ['chosen_inline_result']['from']['id'])){
            $user_id = $this->content ['chosen_inline_result']['from']['id'];
        }
        if ($this->getUpdateType () == 'callback_query' 
        && isset ($this->content ['callback_query']['from']['id'])){
            $user_id = $this->content ['callback_query']['from']['id'];
        }
        if ($this->getUpdateType () == 'shipping_query' 
        && isset ($this->content ['shipping_query']['from']['id'])){
            $user_id = $this->content ['shipping_query']['from']['id'];
        }
        if ($this->getUpdateType () == 'pre_checkout_query' 
        && isset ($this->content ['pre_checkout_query']['from']['id'])){
            $user_id = $this->content ['pre_checkout_query']['from']['id'];
        }
        if ($this->getUpdateType () == 'my_chat_member' 
        && isset ($this->content ['my_chat_member']['from']['id'])){
            $user_id = $this->content ['my_chat_member']['from']['id'];
        }
        if ($this->getUpdateType () == 'chat_member' 
        && isset ($this->content ['chat_member']['from']['id'])){
            $user_id = $this->content ['chat_member']['from']['id'];
        }
        if ($this->getUpdateType () == 'chat_join_request' 
        && isset ($this->content ['chat_join_request']['from']['id'])){
            $user_id = $this->content ['chat_join_request']['from']['id'];
        }
        if ($this->getUpdateType () == 'chat_boost' 
        && isset ($this->content ['chat_boost']['boost']['source']['user']['id'])){
            $user_id = $this->content ['chat_boost']['boost']['source']['user']['id'];
        }
        if ($this->getUpdateType () == 'removed_chat_boost' 
        && isset ($this->content ['removed_chat_boost']['source']['user']['id'])){
            $user_id = $this->content ['removed_chat_boost']['source']['user']['id'];
        }

        if ($this->getUpdateType () == 'message_reaction' 
        && isset ($this->content ['message_reaction']['user']['id'])){
            $user_id = $this->content ['message_reaction']['user']['id'];
        }
        
        if ($this->getUpdateType () == 'poll_answer' 
        && isset ($this->content ['poll_answer']['user']['id'])){
            $user_id = $this->content ['poll_answer']['user']['id'];
        }

        return $user_id ?? $this->content ['message']['from']['id'] ?? null;
    }

    /**
     * [IETF language tag](https://en.wikipedia.org/wiki/IETF_language_tag) of the user's language
     * 
     * @return string
     */
    public function getLanguageCode () :string
    {
        if (isset ($this->content [$this->getUpdateType ()]['from']['language_code'])){
            return $this->content [$this->getUpdateType ()]['from']['language_code'];
        }
        if (isset ($this->content [$this->getUpdateType ()]['user']['language_code'])){
            return $this->content [$this->getUpdateType ()]['user']['language_code'];
        }
        return 'en';
    }

    /**
     * User's or bot's first name
     * 
     * @return string|null
     */
    public function getFirstName () :?string
    {
        if (isset ($this->content [$this->getUpdateType ()]['from']['first_name'])){
            return $this->content [$this->getUpdateType ()]['from']['first_name'];
        }
        if (isset ($this->content [$this->getUpdateType ()]['user']['first_name'])){
            return $this->content [$this->getUpdateType ()]['user']['first_name'];
        }
        return null;
    }
    
    /**
     * User's or bot's last name
     * 
     * @return string|null
     */
    public function getLastName () :?string
    {
        if (isset ($this->content [$this->getUpdateType ()]['from']['last_name'])) {
            return $this->content [$this->getUpdateType ()]['from']['last_name'];
        }
        if (isset ($this->content [$this->getUpdateType ()]['user']['last_name'])) {
            return $this->content [$this->getUpdateType ()]['user']['last_name'];
        }
        return null;
    }
    
    /**
     * User's or bot's full name
     * 
     * @return string|null
     */
    public function getFullName () :?string
    {
        // join first and last name
        return trim ($this->getFirstName ()." ".$this->getLastName ()) ?? null;
    }
    
    /**
     * User's or bot's username
     * 
     * @return string|null
     */
    public function getUsername () :?string
    {
        if (isset ($this->content [$this->getUpdateType ()]['from']['username'])) {
            return $this->content [$this->getUpdateType ()]['from']['username'];
        }
        if (isset ($this->content [$this->getUpdateType ()]['user']['username'])) {
            return $this->content [$this->getUpdateType ()]['user']['username'];
        }
        return null;
    }
    
    /**
     * True, if this user is a Telegram Premium user.
     * 
     * @return bool
     */
    public function isPremium () :bool
    {
        if (isset ($this->content [$this->getUpdateType ()]['from']['is_premium'])) {
            return $this->content [$this->getUpdateType ()]['from']['is_premium'];
        }
        if (isset ($this->content [$this->getUpdateType ()]['user']['is_premium'])) {
            return $this->content [$this->getUpdateType ()]['user']['is_premium'];
        }
        return false;
    }

    /**
     * Unique message identifier inside a chat.
     * 
     * @return int|null
     */
    public function getMessageId () :?int
    {
        if ($this->getUpdateType () == 'edited_message' 
        && isset ($this->content ['edited_message']['message_id'])){
            $message_id = $this->content ['edited_message']['message_id'];
        }
        if ($this->getUpdateType () == 'channel_post' 
        && isset ($this->content['channel_post']['message_id'])){
            $message_id = $this->content ['channel_post']['message_id'];
        }
        if ($this->getUpdateType () == 'edited_channel_post' 
        && isset ($this->content['edited_channel_post']['message_id'])){
            $message_id = $this->content ['edited_channel_post']['message_id'];
        }
        if ($this->getUpdateType () == 'business_message' 
        && isset ($this->content['business_message']['message_id'])){
            $message_id = $this->content ['business_message']['message_id'];
        }
        if ($this->getUpdateType () == 'business_message' 
        && isset ($this->content['business_message']['message_id'])){
            $message_id = $this->content ['business_message']['message_id'];
        }
        if ($this->getUpdateType () == 'message_reaction' 
        && isset ($this->content['message_reaction']['message_id'])){
            $message_id = $this->content ['message_reaction']['message_id'];
        }
        if ($this->getUpdateType () == 'message_reaction_count' 
        && isset ($this->content['message_reaction_count']['message_id'])){
            $message_id = $this->content ['message_reaction_count']['message_id'];
        }
        if ($this->getUpdateType () == 'callback_query' 
        && isset ($this->content['callback_query']['message']['message_id'])){
            $message_id = $this->content ['callback_query']['message']['message_id'];
        }
        
        return $message_id ?? $this->content ['message']['message_id'] ?? null;
    }

    /**
     * For replies in the same chat and message thread, the original message.
     * 
     * @return int|null
     */
    public function getReplyToMessageId () :?int
    {
        return $this->content ['message']['reply_to_message']['message_id'] ?? null;
    }
    
    /**
     * Unique identifier for a chat.
     * This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it.
     * 
     * @return int|null
     */
    public function getChatId () :?int
    {
        if ($this->getUpdateType () == 'edited_message' 
        && isset ($this->content ['edited_message']['chat']['id'])){
            $chat_id = $this->content ['edited_message']['chat']['id'];
        }
        if ($this->getUpdateType () == 'channel_post' 
        && isset ($this->content ['channel_post']['chat']['id'])){
            $chat_id = $this->content ['channel_post']['chat']['id'];
        }
        if ($this->getUpdateType () == 'edited_channel_post' 
        && isset ($this->content ['edited_channel_post']['chat']['id'])){
            $chat_id = $this->content ['edited_channel_post']['chat']['id'];
        }
        if ($this->getUpdateType () == 'business_connection' 
        && isset ($this->content ['business_connection']['user_chat_id'])){
            $chat_id = $this->content ['business_connection']['user_chat_id'];
        }
        if ($this->getUpdateType () == 'business_message' 
        && isset ($this->content ['business_message']['chat']['id'])){
            $chat_id = $this->content ['business_message']['chat']['id'];
        }
        if ($this->getUpdateType () == 'edited_business_message' 
        && isset ($this->content['edited_business_message']['chat']['id'])){
            $chat_id = $this->content ['edited_business_message']['chat']['id'];
        }
        if ($this->getUpdateType () == 'deleted_business_messages' 
        && isset ($this->content ['deleted_business_messages']['chat']['id'])){
            $chat_id = $this->content ['deleted_business_messages']['chat']['id'];
        }
        if ($this->getUpdateType () == 'message_reaction' 
        && isset ($this->content ['message_reaction']['chat']['id'])){
            $chat_id = $this->content ['message_reaction']['chat']['id'];
        }
        if ($this->getUpdateType () == 'message_reaction_count' 
        && isset ($this->content ['message_reaction_count']['chat']['id'])){
            $chat_id = $this->content ['message_reaction_count']['chat']['id'];
        }
        if ($this->getUpdateType () == 'callback_query' 
        && isset ($this->content ['callback_query']['message']['chat']['id'])){
            $chat_id = $this->content ['callback_query']['message']['chat']['id'];
        }
        if ($this->getUpdateType () == 'my_chat_member' 
        && isset ($this->content ['my_chat_member']['chat']['id'])){
            $chat_id = $this->content ['my_chat_member']['chat']['id'];
        }
        if ($this->getUpdateType () == 'chat_member' 
        && isset ($this->content['chat_member']['chat']['id'])){
            $chat_id = $this->content ['chat_member']['chat']['id'];
        }
        if ($this->getUpdateType () == 'chat_join_request' 
        && isset ($this->content ['chat_join_request']['chat']['id'])){
            $chat_id = $this->content ['chat_join_request']['chat']['id'];
        }
        if ($this->getUpdateType () == 'chat_boost' 
        && isset ($this->content ['chat_boost']['chat']['id'])){
            $chat_id = $this->content ['chat_boost']['chat']['id'];
        }
        if ($this->getUpdateType () == 'removed_chat_boost' 
        && isset ($this->content ['removed_chat_boost']['chat']['id'])){
            $chat_id = $this->content ['removed_chat_boost']['chat']['id'];
        }
        
        if ($this->getUpdateType () == 'poll_answer' 
        && isset ($this->content ['poll_answer']['voter_chat']['id'])){
            $chat_id = $this->content ['poll_answer']['voter_chat']['id'];
        }
        
        return $chat_id ?? $this->content ['message']['chat']['id'] ?? null;
    }

    /**
     * Update media type, possible values, photo, animation, audio, document, sticker, video, video_note,
     * voice, contact, dice, game, poll, venue, location, invoice.
     * 
     * @return string|null
     */
    public function getMediaType () :?string
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
        if (isset ($this->getContent ()[$this->getUpdateType ()]['story'])){
            return 'story';
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
    public function getCallbackQueryId () :?int
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
            $chat_type = $this->content ['inline_query']['chat_type'];
        }
        if ($this->getUpdateType () == 'callback_query'){
            $chat_type = $this->content ['callback_query']['message']['chat']['type'];
        }
        if (isset ($this->content [$this->getUpdateType ()]['chat']['type'])){
            $chat_type = $this->content [$this->getUpdateType ()]['chat']['type'];
        }
        return $chat_type ?? 'private';
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

        $url_file = "https://api.telegram.org/file/bot" . Token::$token . "/" . $getFile ['result']['file_path'];
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