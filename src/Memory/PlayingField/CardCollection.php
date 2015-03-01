<?php

namespace Memory\PlayingField;

class CardCollection
{
    private $cards;

    /**
     * @param \Memory\PlayingField\Card $card
     */
    public function add(Card $card)
    {
        $this->cards[] = $card;
    }

    /**
     * @return array
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * Shuffles cards in collection
     */
    public function shuffle()
    {
        shuffle($this->cards);
    }
}
