<?php

namespace spec\Memory\Deck;

use Memory\PlayingField\Card;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CardCollectionSpec extends ObjectBehavior
{
    function it_can_add_cards(Card $firstCard, Card $secondCard)
    {
        $this->add($firstCard);
        $this->add($secondCard);
        $this->getCards()->shouldReturn(array($firstCard, $secondCard));
    }

    function it_can_shuffle_cards(Card $firstCard, Card $secondCard, Card $thirdCard)
    {
        $cards = array($firstCard, $secondCard, $thirdCard);
        $originalCardOrder = array();
        $cardCollectionSize = 20;

        while ($cardCollectionSize--) {
            $card = $cards[array_rand($cards)];
            $originalCardOrder[] = $card;
            $this->add($card);
        }

        $this->shuffle();

        $this->getCards()->shouldNotReturn($originalCardOrder);
    }
}
