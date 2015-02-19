<?php

namespace Memory\Deck;

use Memory\Deck\Exceptions\CardAlreadyRemoved;
use Memory\Deck\Exceptions\CardOutOfScope;

final class Deck
{
    private $cards;

    public function __construct($cards)
    {
        foreach ($cards as $card) {
            $this->add($card);
        }
    }

    /**
     * @param $imagePath
     * @return Deck
     */
    public function add($imagePath)
    {
        $card = new Card($imagePath);
        $this->cards[] = $card;
        return new static($this->cards);
    }

    public function turnCard($position)
    {
        if ($position > $this->cardCount() - 1 || $position < 0) {
            throw new CardOutOfScope(
                "Card on position $position is out of scope"
            );
        }

        if (!isset($this->cards[$position])) {
            throw new CardAlreadyRemoved(
                "Card on position $position has already been removed"
            );
        }

        return $this->cards[$position];
    }

    /**
     * Removes cards from deck
     *
     * @param $firstPosition
     * @param $secondPosition
     * @return Deck
     */
    public function remove($firstPosition, $secondPosition)
    {
        unset($this->cards[$firstPosition], $this->cards[$secondPosition]);
        return new static($this->cards);
    }

    /**
     * Get number of cards left in deck
     *
     * @return int
     */
    public function cardCount()
    {
        return count($this->cards);
    }

    /**
     * Get cards from deck
     *
     * @return Card[]
     */
    public function getCards()
    {
        return $this->cards;
    }
}
