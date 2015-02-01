<?php

namespace Memory;

use Memory\Deck\Card;

class PlaySheet
{
    const MATCH = 1;
    const ODD = 0;

    private $record = array();

    /**
     * @param \Memory\Deck\Card $firstCard
     * @param \Memory\Deck\Card $secondCard
     */
    public function record(Card $firstCard, Card $secondCard)
    {
        if ($firstCard->matches($secondCard)) {
            $this->record[] = PlaySheet::MATCH;
        } else {
            $this->record[] = PlaySheet::ODD;
        }
    }

    /**
     * @return array
     */
    public function getRecords()
    {
        return $this->record;
    }
}
