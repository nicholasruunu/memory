<?php

namespace Memory\Events;

use Memory\PlaySheet;

class GameWasWon
{
    /**
     * @var playSheet
     */
    private $playSheet;

    public function __construct(PlaySheet $playSheet)
    {
        $this->playSheet = $playSheet;
    }

    public function playSheet()
    {
        return $this->playSheet;
    }
}
