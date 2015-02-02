<?php

namespace Memory\Deck;

use Memory\Deck\Exceptions\CardAlreadyRemoved;
use Memory\Deck\Exceptions\CardOutOfScope;

class Deck
{
    private $cards;

    public function __construct(CardCollection $cardCollection)
    {
        $this->cards = $cardCollection->getCards();
    }

    public function turn($position)
    {
        if ($position > count($this->cards) - 1 || $position < 0) {
            throw new CardOutOfScope(
                "Card on position $position is out of scope"
            );
        }

        if ( ! isset($this->cards[$position])) {
            throw new CardAlreadyRemoved(
              "Card on position $position has already been removed"
            );
        }

        return $this->cards[$position];
    }

    public function remove($firstPosition, $secondPosition)
    {
        unset($this->cards[$firstPosition]);
        unset($this->cards[$secondPosition]);
    }
}
