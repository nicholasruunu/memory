<?php

namespace Memory\Events;

use Memory\PlayingField\Card;

class CardWasTurned
{
    /**
     * @var card
     */
    private $card;

    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    public function card()
    {
        return $this->card;
    }
}
