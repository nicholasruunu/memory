<?php

namespace spec\Memory\Deck;

use Memory\Deck\Card;
use Memory\Deck\CardCollection;
use Memory\Deck\Exceptions\CardAlreadyRemoved;
use Memory\Deck\Exceptions\CardOutOfScope;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeckSpec extends ObjectBehavior
{
    private $cards;

    function let(CardCollection $cardCollection, Card $card)
    {
        $this->cards = array($card, $card, $card, $card);
        $cardCollection->getCards()->willReturn($this->cards);

        $this->beConstructedWith($cardCollection);
    }

    function it_can_turn_a_card_by_the_position_in_the_deck()
    {
        $this->turn($position = 0)->shouldHaveType('\Memory\Deck\Card');
    }

    function it_can_not_turn_cards_that_has_been_removed()
    {
        $this->remove(0, 1);
        $this->shouldThrow(CardAlreadyRemoved::class)->duringTurn(0);
        $this->shouldThrow(CardAlreadyRemoved::class)->duringTurn(1);
    }

    function it_can_not_turn_a_card_out_of_deck_scope()
    {
        $maxPosition = count($this->cards) - 1;

        $this->shouldThrow(CardOutOfScope::class)->duringTurn($maxPosition + 1);
        $this->shouldThrow(CardOutOfScope::class)->duringTurn(-1);
    }
}
