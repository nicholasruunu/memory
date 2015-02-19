<?php

namespace Memory\Events;

use Memory\Deck\Deck;
use Rhumsaa\Uuid\Uuid;

final class GameWasStarted
{
    /**
     * @var id
     */
    private $id;

    /**
     * @var deck
     */
    private $deck;

    public function __construct(Uuid $id, Deck $deck)
    {
        $this->id = $id;
        $this->deck = $deck;
    }

    public function id()
    {
        return $this->id;
    }

    public function deck()
    {

    }
}
