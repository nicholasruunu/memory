<?php

namespace spec\Memory\Deck;

use Memory\Deck\Card;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CardCollectionSpec extends ObjectBehavior
{
    function it_can_add_cards(Card $firstCard, Card $secondCard)
    {
        $this->add($firstCard);
        $this->add($secondCard);
        $this->shift()->shouldReturn($firstCard);
        $this->shift()->shouldReturn($secondCard);
    }
}
