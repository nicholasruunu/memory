<?php

namespace Memory;

use Memory\Events\Aggregate\AggregateRoot;
use Memory\Deck\Deck;
use Memory\Events\FirstCardWasTurned;
use Memory\Events\GameWasStarted;
use Memory\Events\GameWasWon;
use Rhumsaa\Uuid\Uuid;

final class Game
{
    use AggregateRoot;

    /**
     * @var Uuid $id
     */
    private $id;

    /**
     * @var Deck $deck
     */
    private $deck;

    /**
     * @var PlaySheet $playSheet
     */
    private $playSheet;

    /**
     * @var array $firstCardTurned
     */
    private $firstCardTurned = false;

    public function id()
    {
        return $this->id;
    }

    public static function start(Uuid $id, Deck $deck)
    {
        $game = new static();
        $game->applyEvent(new GameWasStarted($id, $deck));
        return $game;
    }

    public function turnCard($cardPosition)
    {
        $turnedCard = $this->deck->turnCard($cardPosition);

        if ($this->deck->countCards() === 0) {
            throw new RuntimeException(
                'There is no more cards to draw from, you have won.'
            );
        }

        if (empty($this->firstCardTurned)) {
            $this->firstCardTurned = $turnedCard;
            return $this->applyEvent(new FirstCardWasTurned($turnedCard));
        }

        if (!$this->firstCardTurned->matches($turnedCard)) {
            return $this->applyEvent(new RoundWasLost($turnedCard));
        }

        if ($this->deck->countCards() !== 2) {
            return $this->applyEvent(new RoundWasWon($this->firstCardTurned, $turnedCard));
        }

        return $this->applyEvent(new GameWasWon($this->firstCardTurned, $turnedCard, $this->playSheet));
    }

    private function applyGameWasStarted(GameWasStarted $event)
    {
        $this->id = $event->id();
        $this->deck = $event->deck();
        $this->playSheet = new PlaySheet;
    }

    private function applyFirstCardWasTurned(FirstCardWasTurned $event)
    {
        $this->firstCardTurned = $event->card();
    }

    private function applyRoundWasLost(RoundWasLost $event)
    {
        $this->playSheet = $this->playSheet->record(PlaySheet::ODD);
        $this->firstCardTurned = false;
    }

    private function applyRoundWasWon(RoundWasWon $event)
    {
        $this->deck->remove($event->firstCard(), $event->secondCard());
        $this->playSheet = $this->playSheet->record(PlaySheet::MATCH);
        $this->firstCardTurned = false;
    }

    private function applyGameWasWon(GameWasWon $event)
    {
        $this->applyRoundWasWon(new RoundWasWon($event->firstCard(), $event->secondCard()));
    }
}
