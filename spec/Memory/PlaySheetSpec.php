<?php

namespace spec\Memory;

use Memory\Card\Card;
use Memory\PlaySheet;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PlaySheetSpec extends ObjectBehavior
{
    function it_records_matching_cards(Card $card)
    {
        $card->matches($card)->willReturn(true);
        $this->record($card, $card);
        $this->getRecords()->shouldReturn(array(PlaySheet::MATCH));
    }
}
