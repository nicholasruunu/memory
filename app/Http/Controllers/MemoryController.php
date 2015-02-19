<?php

namespace App\Http\Controllers;

use League\Tactician\CommandBus;
use Rhumsaa\Uuid\Uuid;
use Memory\Commands\StartGame;

class MemoryController extends Controller
{
    /**
     * @var commandBus
     */
    private $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function start($deckSquareLength = 4)
    {
        $gameId = Uuid::uuid4();
        $this->commandBus->handle(new StartGame($gameId, $deckSquareLength));
    }

    /**
     * Listening for the GameWasStarted event
     *
     * @param $event
     */
    public function gameWasStarted($event)
    {
        dd($event);
    }
}
