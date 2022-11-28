# TelegramPhp

[![GitHub license](https://img.shields.io/github/license/httd1/TelegramPhp)](https://github.com/httd1/TelegramPhp/blob/main/LICENSE) [![GitHub stars](https://img.shields.io/github/stars/httd1/TelegramPhp)](https://github.com/httd1/TelegramPhp/stargazers)

Esse é um pacote em PHP para uso da API de bots do Telegram.  
Esse pacote foi pensado para uso exclusivamente por [Webhook](https://core.telegram.org/bots/api#setwebhook), 
antes do uso leia a documentação completa do Telegram aqui https://core.telegram.org/bots/api


## Requisitos

- PHP>=7.0
  - cURL
  - JSON

## Instalação

```shell
composer require httd1/TelegramPhp
```

## Uso:

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
```

## 🔒 Segurança
O Telegram oferece algumas formas de validar se o request recebido veio realmente de seus servidores ([mais aqui](https://core.telegram.org/bots/api#setwebhook)), você pode definir um ```secret_token``` no seu Webhook, todas as requisições terá seu token secreto no header _X-Telegram-Bot-Api-Secret-Token_, usando esse pacote você também pode validar o seu ```secret_token```.

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

## Respondendo comandos
Use os métodos ```command ()``` ou ```commandMatch ()``` para capturar comandos enviados ao bot, uma funcão de callback ou um método de uma classe será executado para esse comando.

- ```command ()``` - Para comandos padrão _/comando_ ou qualquer string simples que você considera um comando, um 👍 por exemplo! Usando ```{{param}}``` você pode nomear parâmetros que espera receber no comando.

```php
$tlg->command ('👍', function ($bot){

  // process command...

});

$tlg->command ('/colors {{color_1}} {{color_2}} {{color_3}}', function ($bot, $data){

  // $data ['color_1']...
  // process command...

});

// run the colors method of ClassBot class
$tlg->command ('/colors {{color_1}} {{color_2}} {{color_3}}', 'ClassBot:methodColors');

// for namespace use '\MyNamespace\ClassBot:colors'
$tlg->command ('/colors {{color_1}} {{color_2}} {{color_3}}', '\MyNamespace\ClassBot:colors');
```

- ```commandMatch ()``` - Para comandos que seguem um padrão diferente, comandos que casam com uma regex expecifica, [urls do telegram](https://regex101.com/r/Ddqz3q/1) por exemplo!

```php
// telegram urls https://t.me/botfather, https://t.me/TelegramBR
$tlg->commandMatch ('/^https?:\/\/t\.me\/\w{5,}$/', function ($bot, $data){

  // $data [0]
  // process command...

});

$tlg->commandMatch ('/^https?:\/\/t\.me\/\w{5,}$/', function ($bot, $data){

  // $data [0]
  // process command...

});

// run the executeLinks method of TelegramBot class
$tlg->commandMatch ('/^https?:\/\/t\.me\/\w{5,}$/', 'TelegramBot:executeLinks');

// for namespace use '\MyNamespace\ClassBot:colors'
$tlg->commandMatch ('/^https?:\/\/t\.me\/\w{5,}$/', '\MyNamespace\TelegramBot:executeLinks');
```

## Alguns dos métodos disponíveis:

``` getText ()```, ``` getUpdateType ()```, ``` getContent ()```, ``` getUserId ()```, ``` getUsername ()```, ``` getFirstName ()```, ``` getLastName ()```, ``` getFullName ()``` - Nome completo do usuário; ``` getLanguageCode ()``` - [ID de idioma do usuário](https://en.wikipedia.org/wiki/IETF_language_tag); ``` getMessageId ()```, ``` getChatId ()```, ``` getMediaType ()``` - Tipo de mídia, _photo, animation, audio, document, sticker, video, video_note, voice, contact, dice, game, poll, venue, location, invoice_; ``` getCallbackQueryId ()```, ``` getChatType ()``` - Tipo de chat, _private, group, supergroup, channel_; ``` saveFile ()``` - Download de um arquivo, recebe como parâmetro o retorno do método ```getFile ()``` e o destino do arquivo, ```setSecretToken``` - Define um token de segurança usado em requisições Webhook(_secret_token_); ```checkSecretToken``` - Verifica _secret_token_ definido com secret token da requisição.

## Métodos e Botões:

Como já viu em exemplos acima ☝ na classe estática ```Methods``` estão disponíveis todos os mótodos da api do Telegram, [lista completa aqui](https://core.telegram.org/bots/api#available-methods), temos outra classe estática ```Buttons``` para criação de botões inline(embutido na mensagem) e de teclado.

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

```inlineKeyBoardUrl ()```, ```inlineKeyBoardCallbackData ()```, ```inlineKeyBoardWebApp ()```, ```inlineKeyBoardLoginUrl ()```, ```inlineKeyBoardSwitchInlineQuery ()```,```inlineKeyBoardSwitchInlineQueryCurrentChat ()```, ```inlineKeyBoardPay ()```

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

- ```forceReply ()``` - Força uma resposta da mensagem, [documentação](https://core.telegram.org/bots/api#forcereply)

- ```replyKeyboardRemove ()``` - Remove o teclado personalizado e mostra o teclado padrão do dispositivo, [documentação](https://core.telegram.org/bots/api#replykeyboardremove)

## Enviando arquivos:

- Enviando audio

```php
Methods::sendAudio ([
  'chat_id' => $bot->getChatId (),
  'audio' => curl_file_create (__DIR__.'/music.mp3'),
  'caption' => 'Description music'
]);
```

- Enviando foto

```php
Methods::sendPhoto ([
  'chat_id' => $bot->getChatId (),
  'photo' => curl_file_create (__DIR__.'/photo.jpg'),
  'caption' => 'Description photo'
]);
```

- Enviando vídeo

```php
Methods::sendVideo ([
  'chat_id' => $bot->getChatId (),
  'video' => curl_file_create (__DIR__.'/video.mp4'),
  'caption' => 'Description video'
]);
```

- Enviando arquivo

```php
Methods::sendDocument ([
  'chat_id' => $bot->getChatId (),
  'document' => curl_file_create (__DIR__.'/application.apk'),
  'caption' => 'Description file'
]);
```

## Download de arquivos

```php

$file = Methods::getFile ([
  'file_id' => 'CQACAgEAAxkBAAIBRGMFiJ_7zH2y9lJZxnn-XesvrBIhAALrAgACBcf5R68w-Z9ZMsgUKQQ'
]);

var_dump ($bot->saveFile ($file, __DIR__.'/music.mp3'));
```

### 🔥 [Envie o seu](https://t.me/httd1) bot feito com esse pecote, ele pode ser listado aqui
• J.M - [@scdownbot](https://t.me/scdownbot)