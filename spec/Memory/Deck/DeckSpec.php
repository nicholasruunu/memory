<?php

namespace spec\Memory\Deck;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeckSpec extends ObjectBehavior
{
    function it_can_turn_a_card_by_the_position_in_the_deck()
    {
        $this->turn($position = 0)->shouldHaveType('\Memory\Deck\Card');
    }
}
