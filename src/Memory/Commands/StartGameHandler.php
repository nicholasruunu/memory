<?php

namespace Memory\Commands;

use Memory\PlayingField\DeckGenerator;
use Memory\Events\EventDispatcher;
use Memory\Game;

final class StartGameHandler
{
    /**
     * @var session
     */
    private $session;

    /**
     * @var dispatcher
     */
    private $dispatcher;

    /**
     * @var deckGenerator
     */
    private $deckGenerator;

    public function __construct(EventDispatcher $dispatcher, DeckGenerator $deckGenerator)
    {
        $this->dispatcher = $dispatcher;
        $this->deckGenerator = $deckGenerator;
    }

    /**
     * @param StartGame $command
     */
    public function handleStartGame(StartGame $command)
    {
        $deck = $this->deckGenerator->generate($command->deckSquareLength());
        $game = Game::start($command->id(), $deck);
        $this->dispatcher->dispatchEvents($game->releaseEvents());
    }
}
