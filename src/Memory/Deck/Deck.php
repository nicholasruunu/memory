<?php

namespace Memory\Deck;

use Memory\Deck\Exceptions\CardAlreadyRemoved;

class Deck
{

    private $cards;

    public function turn($position)
    {
        if ( ! isset($this->cards[$position])) {
            throw new CardAlreadyRemoved('Already Removed');
        }

        return new Card(new \SplFileInfo(__FILE__));
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
