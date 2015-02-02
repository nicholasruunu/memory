<?php

namespace spec\Memory\Deck;

use Memory\Deck\Card;
use Memory\Deck\CardCollection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeckSpec extends ObjectBehavior
{
    function let(CardCollection $cardCollection, Card $card)
    {
        $cards = array($card, $card, $card, $card);
        $cardCollection->getCards()->willReturn($cards);

        $this->beConstructedWith($cardCollection);
    }

    function it_can_turn_a_card_by_the_position_in_the_deck()
    {
        $this->turn($position = 0)->shouldHaveType('\Memory\Deck\Card');
    }

    function it_can_not_turn_cards_that_has_been_removed()
    {
        $this->remove(0, 1);
        $this->shouldThrow(\Memory\Deck\Exceptions\CardAlreadyRemoved::class)->duringTurn(0);
        $this->shouldThrow(\Memory\Deck\Exceptions\CardAlreadyRemoved::class)->duringTurn(1);
    }
}
