<?php

namespace Memory\Events;

use Memory\Deck\Card;

class FirstCardWasTurned
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
