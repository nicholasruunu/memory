<?php

namespace Memory\Deck;

class Deck
{

    public function turn($argument1)
    {
        return new Card(new \SplFileInfo(__FILE__));
    }
}
