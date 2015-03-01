<?php

namespace Memory;

final class PlayingField
{
    private $cards = array();

    /**
     * @param Card[] $cards
     */
    public function __construct($cards)
    {
        $this->cards = $cards;
    }

    /**
     * @param $position
     * @return Card
     * @throws NoCardAtPosition
     */
    public function turnCard($position)
    {
        $this->assertCardAtPosition($position);

        return $this->cards[$position];
    }

    /**
     * Removes cards from deck
     *
     * @param $position
     * @return PlayingField
     * @throws NoCardAtPosition
     */
    public function remove($position)
    {
        $this->assertCardAtPosition($position);

        unset($this->cards[$position]);

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

    /**
     * @param $position
     * @throws NoCardAtPosition
     */
    private function assertCardAtPosition($position)
    {
        if (isset($this->cards[$position])) {
            return;
        }

        throw new NoCardAtPosition(
            "There is no card at $position of the playing field"
        );
    }
}
