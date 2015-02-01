<?php

namespace Memory;

use Memory\Card\Card;

class PlaySheet
{
    const MATCH = 1;
    private $record = array();

    /**
     * @param \Memory\Card\Card $firstCard
     * @param \Memory\Card\Card $secondCard
     */
    public function record(Card $firstCard, Card $secondCard)
    {
        if ($firstCard->matches($secondCard)) {
            $this->record[] = PlaySheet::MATCH;
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
