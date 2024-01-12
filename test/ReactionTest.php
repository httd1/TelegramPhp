<?php

use PHPUnit\Framework\TestCase;
use \TelegramPhp\Reaction;

class ReactionTest extends TestCase {

    public function testReactionTypeEmoji ()
    {

        $reaction_emoji = Reaction::reactionTypeEmoji ('😀');

        $this->assertIsArray ($reaction_emoji);
        $this->assertSame ($reaction_emoji ['type'], 'emoji', 'Método reactionTypeEmoji tem type diferente do esperado!');
        $this->assertSame ($reaction_emoji ['emoji'], '😀', 'Método reactionTypeEmoji tem emoji diferente do esperado!');

    }
    
    public function testReactionTypeCustomEmoji ()
    {

        $reaction_emoji = Reaction::reactionTypeCustomEmoji ('5222271080466496431');

        $this->assertIsArray ($reaction_emoji);
        $this->assertSame ($reaction_emoji ['type'], 'custom_emoji', 'Método reactionTypeCustomEmoji type é diferente do esperado!');
        $this->assertSame ($reaction_emoji ['custom_emoji_id'], '5222271080466496431', 'Método reactionTypeCustomEmoji custom_emoji_id é diferente do esperado!');

    }

    public function testReactionType ()
    {

        $jsonEmoji = Reaction::reactionType ([
            Reaction::reactionTypeEmoji ('😀')
        ]);
        
        $jsonCustomEmoji = Reaction::reactionType ([
            Reaction::reactionTypeCustomEmoji ('5222271080466496431')
        ]);
        
        $this->assertJson ($jsonEmoji, 'Método reactionType não gerou um JSON valido!');
        $this->assertJson ($jsonCustomEmoji, 'Método reactionType não gerou um JSON valido!');

        $this->assertJsonStringEqualsJsonString (\json_encode ([
            ['type' => 'emoji','emoji' => '😀']
        ]), $jsonEmoji);
        
        $this->assertJsonStringEqualsJsonString (\json_encode ([
            ['type' => 'custom_emoji','custom_emoji_id' => '5222271080466496431']
        ]), $jsonCustomEmoji);

    }

}