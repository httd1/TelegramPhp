<?php

use \TelegramPhp\Methods;

class MarkdownBot {

    public function start ($bot, $data)
    {
        Methods::sendMessage ([
            'chat_id' => $bot->getUserId (),
            'text' => 'Send makdown text, <a href="https://core.telegram.org/bots/api#markdownv2-style">Formatting options</a>',
            'parse_mode' => 'html',
            'disable_web_page_preview' => true
        ]);
    }

    public function help ($bot)
    {
        Methods::sendMessage ([
            'chat_id' => $bot->getUserId (),
            'text' => "You can use bold, italic, underlined, strikethrough, and spoiler text, as well as inline links and pre-formatted code in your bots' messages.\nTelegram clients will render them accordingly."
        ]);
    }

    public function markdownText ($bot, $text)
    {

        $text_to_formatting = $text [0];

        $send = Methods::sendMessage ([
            'chat_id' => $bot->getUserId (),
            'text' => "{$text_to_formatting}",
            // 'reply_to_message_id' => $bot->getMessageId (),
            'parse_mode' => 'markdown'
        ]);

        if (!$send ['ok'])
        {
            Methods::sendMessage ([
                'chat_id' => $bot->getUserId (),
                'text' => "Markdown error!",
                'reply_to_message_id' => $bot->getMessageId (),
                'parse_mode' => 'html'
            ]);
        }

    }

    public function defaultResponse ($bot)
    {
        Methods::sendMessage ([
            'chat_id' => $bot->getChatId (),
            'text' => 'Send /help or /start'
        ]);
    }

}