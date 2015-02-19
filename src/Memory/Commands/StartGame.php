<?php

namespace Memory\Commands;

use League\Tactician\Command;
use Rhumsaa\Uuid\Uuid;

final class StartGame implements Command
{
    /**
     * @var Uuid id
     */
    private $id;

    /**
     * @var int $deckSquareLength
     */
    private $deckSquareLength;

    /**
     * @param Uuid $id
     * @param $deckSquareLength
     */
    public function __construct(Uuid $id, $deckSquareLength)
    {
        $this->id = $id;
        $this->deckSquareLength = $deckSquareLength;
    }

    public function id()
    {
        return $this->id;
    }

    public function deckSquareLength()
    {
        return $this->deckSquareLength;
    }

}
