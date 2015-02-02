<?php

namespace Memory\Deck;

use Memory\Deck\Exceptions\CardAlreadyRemoved;
use Memory\Deck\Exceptions\CardOutOfScope;

class Deck
{
    private $cards;

    public function turn($position)
    {
        if ($position > count($this->cards) - 1 || $position < 0) {
            throw new CardOutOfScope;
        }

        if ( ! isset($this->cards[$position])) {
            throw new CardAlreadyRemoved;
        }

        return $this->cards[$position];
    }

    public function remove($firstPosition, $secondPosition)
    {
        unset($this->cards[$firstPosition]);
        unset($this->cards[$secondPosition]);
    }

    public function __construct(CardCollection $cardCollection)
    {
        $this->cards = $cardCollection->getCards();
    }
}
