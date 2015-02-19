<?php

namespace Memory\Commands;

use Memory\Events\EventDispatcher;
use Memory\Game;

final class TurnCardHandler
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
     * @var eventStore
     */
    private $eventStore;

    public function __construct(EventDispatcher $dispatcher, EventStore $eventStore)
    {
        $this->dispatcher = $dispatcher;
        $this->eventStore = $eventStore;
    }

    /**
     * @param TurnCard $command
     */
    public function handleTurnCard(TurnCard $command)
    {
        $events = $this->eventStore->fromAggregate($command->id());

        $game = Game::buildFromHistory($events);
        $game->turnCard($command->cardPosition());

        $newEvents = $game->releaseEvents();
        $this->dispatcher->dispatchEvents($newEvents);
        $this->eventStore->toAggregate($command->id(), $newEvents);
    }
}
