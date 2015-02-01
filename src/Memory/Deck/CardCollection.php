<?php

namespace Memory\Deck;

class CardCollection
{
    private $cards;

    public function add($argument1)
    {
        $this->cards[] = $argument1;
    }

    public function shift()
    {
        return array_shift($this->cards);
    }
}
