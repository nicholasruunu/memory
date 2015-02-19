<?php

namespace Memory\Commands;

use League\Tactician\Command;

final class TurnCard implements Command
{
    private $cardPosition;

    public function __construct($cardPosition)
    {
        $this->cardPosition = $cardPosition;
    }

    public function cardPosition()
    {
        return $this->cardPosition();
    }
}
