<?php

namespace Memory\Events;

use Memory\PlayingField;
use Rhumsaa\Uuid\Uuid;

final class GameWasStarted
{
    /**
     * @var id
     */
    private $id;

    /**
     * @var PlayingField
     */
    private $playingField;

    public function __construct(Uuid $id, PlayingField $playingField)
    {
        $this->id = $id;
        $this->playingField = $playingField;
    }

    public function id()
    {
        return $this->id;
    }

    public function playingField()
    {
        return $this->playingField;
    }
}
