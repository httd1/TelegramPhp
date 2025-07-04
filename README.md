# TelegramPhp

[![GitHub license](https://img.shields.io/github/license/httd1/TelegramPhp)](https://github.com/httd1/TelegramPhp/blob/main/LICENSE) [![GitHub stars](https://img.shields.io/github/stars/httd1/TelegramPhp)](https://github.com/httd1/TelegramPhp/stargazers)

👌 Read this documentation in Portuguese [here](README-pt.md)

This is a package for the Telegram Bots API.  
This package was made exclusively for use with [Webhook](https://core.telegram.org/bots/api#setwebhook).  
Before using this package, please read the entire Telegram Bot API documentation: https://core.telegram.org/bots/api

## Requirements

- PHP >= 7.0
  - cURL
  - JSON

## Installation

```shell
composer require httd1/TelegramPhp
```

## Usage:

```php
<?php

include __DIR__.'/vendor/autoload.php';

use \TelegramPhp\TelegramPhp;
use \TelegramPhp\Methods;
use \TelegramPhp\Buttons;

// set bot token
\TelegramPhp\Config\Token::setToken ('110201543:AAHdqTcvCH1vGWJxfSeofSAs0K5PALDsaw');

$tlg = new TelegramPhp;

$tlg->command ('/start', function ($bot){

  // send message
  Methods::sendMessage ([
    'chat_id' => $bot->getChatId (),
    'text' => 'Hello 👋'
  ]);

});

// Passing parameters to a command with {{info}}
$tlg->command ('/get {{info}}', function ($bot, $data){

  switch ($data ['info']){
    case 'id':
      $user_info = $bot->getUserId ();
      break;
    case 'username':
      $user_info = $bot->getUsername ();
      break;
    case 'name':
      $user_info = $bot->getFullName ();
      break;
    default:
      $user_info = "Use <code>/get id or username or name</code>";
  }

  Methods::sendMessage ([
    'chat_id' => $bot->getChatId (),
    'text' => "User Info: <b>{$user_info}</b>",
    'parse_mode' => 'html',
    'reply_markup' => Buttons::inlineKeyBoard ([
      [Buttons::inlineKeyBoardUrl ("Link My Profile", "tg://user?id=".$bot->getUserId ())],
      [Buttons::inlineKeyBoardCallbackData ("Ok, Thanks 👍", "/ok")]
    ])
  ]);

});

// match pattern
$tlg->commandMatch ('/^\/ok$/', function ($bot){

  Methods::answerCallbackQuery ([
    'callback_query_id' => $bot->getCallbackQueryId (),
    'text' => '💪 Bro'
  ]);

});

// commandDefault aways in the end of code!
$tlg->commandDefault (function ($bot){

  Methods::sendMessage ([
    'chat_id' => $bot->getChatId (),
    'text' => 'Chose a command /start, /info with id, name or username'
  ]);

});
```

## 🔒 Secure

Telegram provides ways to verify if a request actually comes from its servers ([read more here](https://core.telegram.org/bots/api#setwebhook)).   
You can set a ```secret_token``` in your webhook, and Telegram will include this token in the _X-Telegram-Bot-Api-Secret-Token_ header.
This package allows you to validate your ```secret_token```.

```php

$secret_token = 'wubbalubbadub_dub';

// set secret_token in webhook
// Methods::setWebhook ([
//   'url' => 'https://url.com/mybot/',
//   'secret_token' => $secret_token
// ]);

// my secret token
$tlg->setSecretToken ($secret_token);

if ($tlg->checkSecretToken () == false){
    http_response_code (401);
}

```

## Handling Commands
Use the methods ```command ()```, ```commandMatch ()``` or ```commandDefault``` to catch and handle commands sent to your bot. Each method receives a callback or class method.

- ```command ()``` - Use for standard Telegram commands like _/comando_ or simple inputs that you consider a command, such as '👍'. You can use ```{{param}}``` to define expected parameters.

```php
$tlg->command ('👍', function ($bot){

  // process command...

});

$tlg->command ('/colors {{color_1}} {{color_2}} {{color_3}}', function ($bot, $data){

  // $data ['color_1']...
  // process command...

});

// run the colors method of ClassBot class
// $tlg->command ('/colors {{color_1}} {{color_2}} {{color_3}}', 'ClassBot:methodColors');

// for namespace use '\MyNamespace\ClassBot:colors'
// $tlg->command ('/colors {{color_1}} {{color_2}} {{color_3}}', '\MyNamespace\ClassBot:colors');
```

- ```commandMatch ()``` - For some kind of commands, you can build you own pattern using regular expression such as [telegram urls](https://regex101.com/r/Ddqz3q/1) for example!

```php
// telegram urls https://t.me/botfather, https://t.me/TelegramBR
$tlg->commandMatch ('/^https?:\/\/t\.me\/\w{5,}$/', function ($bot, $data){

  // $data [0]
  // process command...

});

// run the executeLinks method of TelegramBot class
// $tlg->commandMatch ('/^https?:\/\/t\.me\/\w{5,}$/', 'TelegramBot:executeLinks');

// for namespace use '\MyNamespace\ClassBot:colors'
// $tlg->commandMatch ('/^https?:\/\/t\.me\/\w{5,}$/', '\MyNamespace\TelegramBot:executeLinks');
```

- ```commandDefault ()``` - Fallback handler when no command matches.
  
```php

// ...command
// ...commandMatch

// in the end of code!
$tlg->commandDefault (function ($bot){
  
  // send default message

});

// $tlg->commandDefault ('ControllerBot:default');


```

## Some methods available:

``` getText ()```, ``` getUpdateType ()```, ``` getContent ()```, ``` getUserId ()```, ``` getUsername ()```, ``` getFirstName ()```, ``` getLastName ()```, ``` getFullName ()``` - User full name; ``` getLanguageCode ()``` - [List of languages ID](https://en.wikipedia.org/wiki/IETF_language_tag); ``` getMessageId ()```, ``` getChatId ()```, ``` getMediaType ()``` - Media type, _photo, animation, audio, document, sticker, story, video, video_note, voice, contact, dice, game, poll, venue, location, invoice_; ``` getCallbackQueryId ()```, ``` getChatType ()``` - Chat type, _private, group, supergroup, channel_; ``` saveFile ()``` - Download a file, receive with paramether a return of ```getFile ()``` and the file destination; ```setSecretToken ()``` - Set a token used in Webhook(_secret_token_) updates; ```checkSecretToken ()``` - Checks the _secret_token_ set on the the webhook.

## Buttons:

Use the static Buttons class to create inline or reply keyboards.

![](https://i.imgur.com/0ArtHn9.jpg)

```php
Methods::sendMessage ([
  'chat_id' => $bot->getUserId (),
  'text' => '(☞ﾟヮﾟ)☞',
  'reply_markup' => Buttons::inlineKeyBoard ([
    [Buttons::inlineKeyBoardCallbackData ('Hello', '/hello')],
    // [Buttons::inlineKeyBoardUrl ('Open Link', 'https://google.com')]
  ])
]);
```

```inlineKeyBoardUrl ()```, ```inlineKeyBoardCallbackData ()```, ```inlineKeyBoardWebApp ()```, ```inlineKeyBoardLoginUrl ()```, ```inlineKeyBoardSwitchInlineQuery ()```,```inlineKeyBoardSwitchInlineQueryCurrentChat ()```, ```inlineKeyBoardPay ()```, ```inlineKeyBoardCopyText```, ```inlineKeyBoardSwitchInlineQueryChosenChat```

![](https://i.imgur.com/a0NxbBK.jpg)

```php
Methods::sendMessage ([
  'chat_id' => $bot->getUserId (),
  'text' => 'Hello 👋',
  'reply_markup' => Buttons::replyKeyBoardMarkup ([
    [Buttons::keyBoardButtonText ('Hello')],
    // [Buttons::keyBoardButtonRequestContact ('share your contact')]
  ])
]);
```

```keyBoardButtonText ()```, ```keyBoardButtonRequestContact ()```, ```keyBoardButtonRequestLocation ()```, ```keyBoardButtonRequestPoll ()```, ```keyBoardButtonWebApp ()```


![](https://i.imgur.com/6pL7QFe.jpg)

```php
Methods::sendMessage ([
  'chat_id' => $bot->getChatId (),
  'text' => '😍🤔👌🔥🤦',
  'reply_markup' => Buttons::forceReply ()
]);
```

- ```forceReply ()``` - Force a reply to the message, [documentation](https://core.telegram.org/bots/api#forcereply)

```php

Methods::sendMessage([
  'chat_id' => $bot->getChatId(),
  'text' => 'Message with force reply',
  'reply_markup' => Buttons::forceReply()
]);

```

- ```replyKeyboardRemove ()``` - Removes the Telegram keyboard buttons and displays the device keyboard, [documentation](https://core.telegram.org/bots/api#replykeyboardremove)

```php

Methods::sendMessage([
  'chat_id' => $bot->getChatId(),
  'text' => 'Keyboard removed',
  'reply_markup' => Buttons::replyKeyboardRemove()
]);

```
## Message reactions
Telegram Bots can react to messages using simple emojis such as 👍, 👌, 🔥, 😍... or custom emojis.  
[You can see the all available reaction emoji here](https://core.telegram.org/bots/api#reactiontypeemoji)
We have ```Reaction```, an static class for reacting to messages.

- Reaction with ❤  
![Reacting with ❤](https://i.imgur.com/I1GVoxF.jpg)
```php
Methods::setMessageReaction ([
  'chat_id' => $bot->getChatId (),
  'message_id' => $bot->getMessageId (),
  'reaction' => Reaction::reactionType ([
      Reaction::reactionTypeEmoji ('❤'),
  ])
]);
```

- Reacting with custom emojis![5445284980978621387](https://i.imgur.com/3RwZ5oW.gif)  
![Reacting with custom emojis](https://i.imgur.com/Vz5Eqhh.jpg)
```php
Methods::setMessageReaction ([
  'chat_id' => $bot->getChatId (),
  'message_id' => $bot->getMessageId (),
  'reaction' => Reaction::reactionType ([
      Reaction::reactionTypeCustomEmoji ('5445284980978621387'),
  ])
]);
```

## Send files:

- Send audio

```php
Methods::sendAudio ([
  'chat_id' => $bot->getChatId (),
  'audio' => curl_file_create (__DIR__.'/music.mp3'),
  'caption' => 'Description music'
]);
```

- Send photo

```php
Methods::sendPhoto ([
  'chat_id' => $bot->getChatId (),
  'photo' => curl_file_create (__DIR__.'/photo.jpg'),
  'caption' => 'Description photo'
]);
```

- Send video

```php
Methods::sendVideo ([
  'chat_id' => $bot->getChatId (),
  'video' => curl_file_create (__DIR__.'/video.mp4'),
  'caption' => 'Description video'
]);
```

- Send file

```php
Methods::sendDocument ([
  'chat_id' => $bot->getChatId (),
  'document' => curl_file_create (__DIR__.'/application.apk'),
  'caption' => 'Description file'
]);
```

## Download files

```php

$file = Methods::getFile ([
  'file_id' => 'CQACAgEAAxkBAAIBRGMFiJ_7zH2y9lJZxnn-XesvrBIhAALrAgACBcf5R68w-Z9ZMsgUKQQ'
]);

var_dump ($bot->saveFile ($file, __DIR__.'/music.mp3'));
```

## Logs
You can capture bot logs using ```\TelegramPhp\Config\Logs```, symple set one or more classes to catch all user logs.

- Class to catch and process all user logs.
```php
class LogCommands {
  // method log is required
  public function log ($telegramPhp, $action, $route, $data){
    // process data
  }
}
```

- Setting class ```LogCommands``` on the ```\TelegramPhp\Config\Logs```
```php
\TelegramPhp\Config\Logs::catchLogs ([
  LogCommands::class,
  // LogStatistics::class
]);
```

## Updates types
It's possible to execute a callback for a specific type of [Updates](https://core.telegram.org/bots/api#update) sent by the Telegram API, for example, executing a callback to '_my_chat_member_' or '_chat_member_'.

- Handling '_my_chat_member_' updates
```php
$tlg->on ('my_chat_member', function ($bot){
  // code here
});
// $tlg->on (['message_reaction', 'message'], function ($bot){
  // code here
// });
```
- Handling '_chat_member_' updates
```php
$tlg->on ('chat_member', 'TelegramBot:myChatMember');
```

### 🔥 [Share your project made with this class](https://t.me/httd1), your project could be featured here!
• J.M  
- [@scdownbot](https://t.me/scdownbot) (+50K Users)
- [@twitterdlrobot](https://t.me/twitterdlrobot) (+20K Users)
- Off [@rastreiorobot](https://t.me/rastreiorobot) (+14K Users)
- [@btn_bot](https://t.me/btn_bot) (+200 Users)
- [@mailtemprobot](https://t.me/mailtemprobot) (+5k Users)