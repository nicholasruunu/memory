<?php

namespace Memory\PlayingField;

use Memory\PlayingField;

final class IncompletePlayingField
{
    private $cards = array();
    private $numberOfCards = 0;
    private $playingFieldCompleted = false;

    private function __construct($rowLength = 0, $numberOfCards = 0, $cards = array())
    {
        $this->numberOfCards = $numberOfCards;

        if ($rowLength) {
            $this->numberOfCards = pow($rowLength, 2);
        }

        $this->cards = $cards;
    }

    public static function size($rowLength)
    {
        return new self($rowLength);
    }

    /**
     * @param Card $card
     * @return PlayingField|InCompletePlayingField
     * @throws PlayingFieldCompleted
     */
    public function putDownRandomly(Card $card)
    {
        if ($this->playingFieldCompleted) {
            throw new PlayingFieldCompleted(
                "Cards can not be added once playing field is completed."
            );
        }

        $this->cards[$this->randomEmptyPosition()] = $card;

        if (!$this->possiblePositions()) {
            $this->playingFieldCompleted = true;
            return new PlayingField($this->cards);
        }

        return new self(null, $this->numberOfCards, $this->cards);
    }

    private function randomEmptyPosition()
    {
        $possiblePositions = $this->possiblePositions();

        if (!$possiblePositions) {
            return false;
        }

        $randomKey = array_rand($possiblePositions);
        return $possiblePositions[$randomKey];
    }

    /**
     * @return array
     */
    private function possiblePositions()
    {
        $allPositions = range(1, $this->numberOfCards);
        return array_diff($allPositions, array_keys($this->cards));
    }
}
