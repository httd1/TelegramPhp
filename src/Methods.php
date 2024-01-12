<?php

namespace TelegramPhp;

use \TelegramPhp\Request\Request;

class Methods {

    /**
     * Call a method for request in api.
     * 
     * @param string $method Methods available in api https://core.telegram.org/bots/api#available-methods
     * @param array $data
     * @param string $method_request Type request, POST or GET
     * 
     * @return array
     */
    public static function call (string $method, array $data, string $method_request = 'POST') :array
    {
        
        $_handler = new Request;
        $_handler->setMethodRequest ($method_request);
        
        return $_handler->request ($method, $data);
        
    }
    
    /**
     * A simple method for testing your bot's authentication token.
     * Requires no parameters. Returns basic information about the bot in form of a User object.
     * 
     * @see https://core.telegram.org/bots/api#getme
     * 
     * @return array
     */
    public static function getMe ()
    {
        return self::call (__FUNCTION__, []);
    }
    
    /**
     * Use this method to close the bot instance before moving it from one local server to another.
     * 
     * @see https://core.telegram.org/bots/api#close
     * 
     * @return array
     */
    public static function logOut ()
    {
        return self::call (__FUNCTION__, []);
    }

    /**
     * Use this method to specify a URL and receive incoming updates via an outgoing webhook.
     * 
     * @see https://core.telegram.org/bots/api#setwebhook
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setWebhook (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to remove webhook integration if you decide to switch back to [getUpdates](https://core.telegram.org/bots/api#getupdates).
     * 
     * @see https://core.telegram.org/bots/api#deletewebhook
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function deleteWebhook (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get current webhook status.
     * Requires no parameters.
     * 
     * @see https://core.telegram.org/bots/api#getwebhookinfo
     * 
     * @return array
     */
    public static function getWebhookInfo () :array
    {
        return self::call (__FUNCTION__, $data);
    }

    /**
     * Use this method to send text messages.
     * 
     * @see https://core.telegram.org/bots/api#sendmessage
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendMessage (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to forward messages of any kind.
     * 
     * @see https://core.telegram.org/bots/api#forwardmessage
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function forwardMessage (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to forward messages of any kind.
     * 
     * @see https://core.telegram.org/bots/api#forwardmessages
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function forwardMessages (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to copy messages of any kind.
     * 
     * @see https://core.telegram.org/bots/api#copymessage
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function copyMessage (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to copy messages of any kind.
     * 
     * @see https://core.telegram.org/bots/api#copymessages
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function copyMessages (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send photos.
     * 
     * @see https://core.telegram.org/bots/api#sendphoto
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendPhoto (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player.
     * 
     * @see https://core.telegram.org/bots/api#sendaudio
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendAudio (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send general files.
     * 
     * @see https://core.telegram.org/bots/api#senddocument
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendDocument (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send video files, Telegram clients support MPEG4 videos (other formats may be sent as Document).
     * 
     * @see https://core.telegram.org/bots/api#sendvideo
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendVideo (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound).
     * 
     * @see https://core.telegram.org/bots/api#sendanimation
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendAnimation (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message.
     * 
     * @see https://core.telegram.org/bots/api#sendvoice
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendVoice (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * As of v.4.0, Telegram clients support rounded square MPEG4 videos of up to 1 minute long.
     * 
     * @see https://core.telegram.org/bots/api#sendvideonote
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendVideoNote (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send a group of photos, videos, documents or audios as an album.
     * 
     * @see https://core.telegram.org/bots/api#sendmediagroup
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendMediaGroup (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send point on the map.
     * 
     * @see https://core.telegram.org/bots/api#sendlocation
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendLocation (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to edit live location messages.
     * 
     * @see https://core.telegram.org/bots/api#editmessagelivelocation
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function editMessageLiveLocation (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to stop updating a live location message before live_period expires.
     * 
     * @see https://core.telegram.org/bots/api#stopmessagelivelocation
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function stopMessageLiveLocation (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send information about a venue.
     * 
     * @see https://core.telegram.org/bots/api#sendvenue
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendVenue (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send phone contacts.
     * 
     * @see https://core.telegram.org/bots/api#sendcontact
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendContact (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send a native poll.
     * 
     * @see https://core.telegram.org/bots/api#sendpoll
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendPoll (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send an animated emoji that will display a random value.
     * 
     * @see https://core.telegram.org/bots/api#senddice
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendDice (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method when you need to tell the user that something is happening on the bot's side.
     * 
     * @see https://core.telegram.org/bots/api#sendchataction
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendChatAction (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to change the chosen reactions on a message.
     * 
     * @see https://core.telegram.org/bots/api#setmessagereaction
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setMessageReaction (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get a list of profile pictures for a user.
     * 
     * @see https://core.telegram.org/bots/api#getuserprofilephotos
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function getUserProfilePhotos (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get basic information about a file and prepare it for downloading.
     * 
     * @see https://core.telegram.org/bots/api#getfile
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function getFile (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to ban a user in a group, a supergroup or a channel.
     * 
     * @see https://core.telegram.org/bots/api#banchatmember
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function banChatMember (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to unban a previously banned user in a supergroup or channel.
     * 
     * @see https://core.telegram.org/bots/api#unbanchatmember
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function unbanChatMember (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to restrict a user in a supergroup.
     * 
     * @see https://core.telegram.org/bots/api#restrictchatmember
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function restrictChatMember (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to promote or demote a user in a supergroup or a channel.
     * 
     * @see https://core.telegram.org/bots/api#promotechatmember
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function promoteChatMember (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to set a custom title for an administrator in a supergroup promoted by the bot.
     * 
     * @see https://core.telegram.org/bots/api#setchatadministratorcustomtitle
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setChatAdministratorCustomTitle (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to ban a channel chat in a supergroup or a channel.
     * 
     * @see https://core.telegram.org/bots/api#banchatsenderchat
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function banChatSenderChat (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to unban a previously banned channel chat in a supergroup or channel.
     * 
     * @see https://core.telegram.org/bots/api#unbanchatsenderchat
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function unbanChatSenderChat (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to set default chat permissions for all members.
     * 
     * @see https://core.telegram.org/bots/api#setchatpermissions
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setChatPermissions (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to generate a new primary invite link for a chat; any previously generated primary link is revoked.
     * 
     * @see https://core.telegram.org/bots/api#exportchatinvitelink
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function exportChatInviteLink (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to create an additional invite link for a chat.
     * 
     * @see https://core.telegram.org/bots/api#createchatinvitelink
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function createChatInviteLink (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to edit a non-primary invite link created by the bot.
     * 
     * @see https://core.telegram.org/bots/api#editchatinvitelink
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function editChatInviteLink (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to revoke an invite link created by the bot.
     * 
     * @see https://core.telegram.org/bots/api#revokechatinvitelink
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function revokeChatInviteLink (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to approve a chat join request.
     * 
     * @see https://core.telegram.org/bots/api#approvechatjoinrequest
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function approveChatJoinRequest (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to decline a chat join request.
     * 
     * @see https://core.telegram.org/bots/api#declinechatjoinrequest
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function declineChatJoinRequest (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to set a new profile photo for the chat.
     * 
     * @see https://core.telegram.org/bots/api#setchatphoto
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setChatPhoto (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to delete a chat photo.
     * 
     * @see https://core.telegram.org/bots/api#deletechatphoto
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function deleteChatPhoto (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to change the title of a chat.
     * 
     * @see https://core.telegram.org/bots/api#setchattitle
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setChatTitle (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to change the description of a group, a supergroup or a channel.
     * 
     * @see https://core.telegram.org/bots/api#setchatdescription
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setChatDescription (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to add a message to the list of pinned messages in a chat.
     * 
     * @see https://core.telegram.org/bots/api#pinchatmessage
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function pinChatMessage (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to remove a message from the list of pinned messages in a chat.
     * 
     * @see https://core.telegram.org/bots/api#unpinchatmessage
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function unpinChatMessage (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to clear the list of pinned messages in a chat.
     * 
     * @see https://core.telegram.org/bots/api#unpinallchatmessages
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function unpinAllChatMessages (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method for your bot to leave a group, supergroup or channel.
     * 
     * @see https://core.telegram.org/bots/api#leavechat
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function leaveChat (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.).
     * 
     * @see https://core.telegram.org/bots/api#getchat
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function getChat (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get a list of administrators in a chat, which aren't bots.
     * 
     * @see https://core.telegram.org/bots/api#getchatadministrators
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function getChatAdministrators (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get the number of members in a chat.
     * 
     * @see https://core.telegram.org/bots/api#getchatmembercount
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function getChatMemberCount (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get information about a member of a chat.
     * 
     * @see https://core.telegram.org/bots/api#getchatmember
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function getChatMember (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to set a new group sticker set for a supergroup.
     * 
     * @see https://core.telegram.org/bots/api#setchatstickerset
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setChatStickerSet (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to delete a group sticker set from a supergroup.
     * 
     * @see https://core.telegram.org/bots/api#deletechatstickerset
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function deleteChatStickerSet (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }

    /**
     * Use this method to get custom emoji stickers, which can be used as a forum topic icon by any user.
     * 
     * @see https://core.telegram.org/bots/api#getforumtopiciconstickers
     * 
     * @return array
     */
    public static function getForumTopicIconStickers () :array
    {
        return self::call (__FUNCTION__, []);
    }
    
    /**
     * Use this method to create a topic in a forum supergroup chat.
     * 
     * @see https://core.telegram.org/bots/api#createforumtopic
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function createForumTopic (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to edit name and icon of a topic in a forum supergroup chat.
     * 
     * @see https://core.telegram.org/bots/api#editforumtopic
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function editForumTopic (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to close an open topic in a forum supergroup chat.
     * 
     * @see https://core.telegram.org/bots/api#closeforumtopic
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function closeForumTopic (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to reopen a closed topic in a forum supergroup chat.
     * 
     * @see https://core.telegram.org/bots/api#reopenforumtopic
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function reopenForumTopic (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to delete a forum topic along with all its messages in a forum supergroup chat.
     * 
     * @see https://core.telegram.org/bots/api#deleteforumtopic
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function deleteForumTopic (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to clear the list of pinned messages in a forum topic.
     * 
     * @see https://core.telegram.org/bots/api#unpinallforumtopicmessages
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function unpinAllForumTopicMessages (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to edit the name of the 'General' topic in a forum supergroup chat.
     * 
     * @see https://core.telegram.org/bots/api#editgeneralforumtopic
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function editGeneralForumTopic (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to close an open 'General' topic in a forum supergroup chat.
     * 
     * @see https://core.telegram.org/bots/api#closegeneralforumtopic
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function closeGeneralForumTopic (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to reopen a closed 'General' topic in a forum supergroup chat.
     * 
     * @see https://core.telegram.org/bots/api#reopengeneralforumtopic
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function reopenGeneralForumTopic (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to hide the 'General' topic in a forum supergroup chat.
     * 
     * @see https://core.telegram.org/bots/api#hidegeneralforumtopic
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function hideGeneralForumTopic (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to unhide the 'General' topic in a forum supergroup chat.
     * 
     * @see https://core.telegram.org/bots/api#unhidegeneralforumtopic
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function unhideGeneralForumTopic (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to clear the list of pinned messages in a General forum topic.
     * The bot must be an administrator in the chat for this to work and must have the can_pin_messages administrator right in the supergroup.
     * 
     * @see https://core.telegram.org/bots/api#unpinallgeneralforumtopicmessages
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function unpinAllGeneralForumTopicMessages (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send answers to callback queries sent from inline keyboards.
     * 
     * @see https://core.telegram.org/bots/api#answercallbackquery
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function answerCallbackQuery (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get the list of boosts added to a chat by a user.
     * 
     * @see https://core.telegram.org/bots/api#getuserchatboosts
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function getUserChatBoosts (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to change the list of the bot's commands.
     * See https://core.telegram.org/bots#commands for more details about bot commands.
     * 
     * @see https://core.telegram.org/bots/api#setmycommands
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setMyCommands (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to delete the list of the bot's commands for the given scope and user language.
     * 
     * @see https://core.telegram.org/bots/api#deletemycommands
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function deleteMyCommands (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get the current list of the bot's commands for the given scope and user language.
     * 
     * @see https://core.telegram.org/bots/api#getmycommands
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function getMyCommands (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to change the bot's name.
     * 
     * @see https://core.telegram.org/bots/api#setmyname
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setMyName (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get the current bot name for the given user language.
     * 
     * @see https://core.telegram.org/bots/api#getmyname
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function getMyName (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to change the bot's description, which is shown in the chat with the bot if the chat is empty.
     * 
     * @see https://core.telegram.org/bots/api#setmydescription
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setMyDescription (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get the current bot description for the given user language.
     * 
     * @see https://core.telegram.org/bots/api#getmydescription
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function getMyDescription (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to change the bot's short description, which is shown on the bot's profile page and is sent together with the link when users share the bot.
     * 
     * @see https://core.telegram.org/bots/api#setmyshortdescription
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setMyShortDescription (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get the current bot short description for the given user language.
     * 
     * @see https://core.telegram.org/bots/api#getmyshortdescription
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function getMyShortDescription (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to change the bot's menu button in a private chat, or the default menu button.
     * 
     * @see https://core.telegram.org/bots/api#setchatmenubutton
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setChatMenuButton (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get the current value of the bot's menu button in a private chat, or the default menu button.
     * 
     * @see https://core.telegram.org/bots/api#getchatmenubutton
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function getChatMenuButton (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to change the default administrator rights requested by the bot when it's added as an administrator to groups or channels.
     * 
     * @see https://core.telegram.org/bots/api#setmydefaultadministratorrights
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setMyDefaultAdministratorRights (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get the current default administrator rights of the bot.
     * 
     * @see https://core.telegram.org/bots/api#getmydefaultadministratorrights
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function getMyDefaultAdministratorRights (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to edit text and game messages.
     * 
     * @see https://core.telegram.org/bots/api#editmessagetext
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function editMessageText (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to edit captions of messages.
     * 
     * @see https://core.telegram.org/bots/api#editmessagecaption
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function editMessageCaption (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to edit animation, audio, document, photo, or video messages.
     * 
     * @see https://core.telegram.org/bots/api#editmessagemedia
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function editMessageMedia (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to edit only the reply markup of messages.
     * 
     * @see https://core.telegram.org/bots/api#editmessagereplymarkup
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function editMessageReplyMarkup (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to stop a poll which was sent by the bot.
     * 
     * @see https://core.telegram.org/bots/api#stoppoll
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function stopPoll (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to delete a message, including service messages, with the following limitations:
     * - A message can only be deleted if it was sent less than 48 hours ago.
     * - A dice message in a private chat can only be deleted if it was sent more than 24 hours ago.
     * - Bots can delete outgoing messages in private chats, groups, and supergroups.
     * - Bots can delete incoming messages in private chats.
     * - Bots granted can_post_messages permissions can delete outgoing messages in channels.
     * - If the bot is an administrator of a group, it can delete any message there.
     * - If the bot has can_delete_messages permission in a supergroup or a channel, it can delete any message there.
     * 
     * @see https://core.telegram.org/bots/api#deletemessage
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function deleteMessage (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to delete multiple messages simultaneously
     * 
     * @see https://core.telegram.org/bots/api#deleteMessages
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function deleteMessages (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send static .WEBP, animated .TGS, or video .WEBM stickers.
     * 
     * @see https://core.telegram.org/bots/api#sendsticker
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendSticker (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get a sticker set.
     * 
     * @see https://core.telegram.org/bots/api#getstickerset
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function getStickerSet (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get information about custom emoji stickers by their identifiers.
     * 
     * @see https://core.telegram.org/bots/api#getcustomemojistickers
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function getCustomEmojiStickers (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to upload a .PNG file with a sticker for later use in createNewStickerSet and addStickerToSet methods (can be used multiple times).
     * 
     * @see https://core.telegram.org/bots/api#uploadstickerfile
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function uploadStickerFile (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to create a new sticker set owned by a user.
     * 
     * @see https://core.telegram.org/bots/api#createnewstickerset
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function createNewStickerSet (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to add a new sticker to a set created by the bot.
     * 
     * @see https://core.telegram.org/bots/api#addstickertoset
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function addStickerToSet (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to move a sticker in a set created by the bot to a specific position.
     * 
     * @see https://core.telegram.org/bots/api#setstickerpositioninset
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setStickerPositionInSet (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to delete a sticker from a set created by the bot.
     * 
     * @see https://core.telegram.org/bots/api#deletestickerfromset
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function deleteStickerFromSet (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to change the list of emoji assigned to a regular or custom emoji sticker.
     * 
     * @see https://core.telegram.org/bots/api#setstickeremojilist
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setStickerEmojiList (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to change search keywords assigned to a regular or custom emoji sticker.
     * 
     * @see https://core.telegram.org/bots/api#setstickerkeywords
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setStickerKeywords (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to change the mask position of a mask sticker.
     * 
     * @see https://core.telegram.org/bots/api#setstickermaskposition
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setStickerMaskPosition (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to set the title of a created sticker set.
     * 
     * @see https://core.telegram.org/bots/api#setstickersettitle
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setStickerSetTitle (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to set the thumbnail of a sticker set.
     * 
     * @see https://core.telegram.org/bots/api#setStickerSetThumbnail
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setStickerSetThumbnail (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to set the thumbnail of a custom emoji sticker set.
     * 
     * @see https://core.telegram.org/bots/api#setcustomemojistickersetthumbnail
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setCustomEmojiStickerSetThumbnail (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to delete a sticker set that was created by the bot.
     * 
     * @see https://core.telegram.org/bots/api#deletestickerset
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function deleteStickerSet (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send answers to an inline query.
     * 
     * @see https://core.telegram.org/bots/api#answerinlinequery
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function answerInlineQuery (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to set the result of an interaction with a Web App and send a corresponding message on behalf of the user to the chat from which the query originated.
     * 
     * @see https://core.telegram.org/bots/api#answerwebappquery
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function answerWebAppQuery (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send invoices.
     * 
     * @see https://core.telegram.org/bots/api#sendinvoice
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendInvoice (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to create a link for an invoice.
     * 
     * @see https://core.telegram.org/bots/api#createinvoicelink
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function createInvoiceLink (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to reply to shipping queries.
     * - If you sent an invoice requesting a shipping address and the parameter is_flexible was specified, the Bot API will send an Update with a shipping_query field to the bot.
     * 
     * @see https://core.telegram.org/bots/api#answershippingquery
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function answerShippingQuery (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to respond to such pre-checkout queries.
     * - Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an Update with the field pre_checkout_query.
     * 
     * @see https://core.telegram.org/bots/api#answerprecheckoutquery
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function answerPreCheckoutQuery (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to send a game
     * 
     * @see https://core.telegram.org/bots/api#sendgame
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sendGame (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to set the score of the specified user in a game message.
     * 
     * @see https://core.telegram.org/bots/api#setgamescore
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function setGameScore (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
    /**
     * Use this method to get data for high score tables.
     * 
     * @see https://core.telegram.org/bots/api#getgamehighscores
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function getGameHighScores (array $data) :array
    {
        return self::call (__FUNCTION__, $data);
    }
    
}