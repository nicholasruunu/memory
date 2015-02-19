<?php

namespace Memory\Events;

class MatchingCardsWasTurned
{
    private $cards;

    public function __construct(Card $firstCard, Card $secondCard)
    {
        $this->cards = array($firstCard, $secondCard);
    }

    public function cards()
    {
        return $this->cards;
    }
}
