<?php

namespace Memory;

use Memory\Events\Aggregate\AggregateRoot;
use Memory\Events\CardWasTurned;
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
     * @var PlayingField $playingField
     */
    private $playingField;

    /**
     * @var PlaySheet $playSheet
     */
    private $playSheet;

    /**
     * @var array $turnedCards
     */
    private $turnedCards = array();

    public function id()
    {
        return $this->id;
    }

    public static function start(Uuid $id, PlayingField $playingField)
    {
        $game = new static();
        $game->applyEvent(new GameWasStarted($id, $playingField));
        return $game;
    }

    public function turnCard($cardPosition)
    {
        $card = $this->playingField->turnCard($cardPosition);
        $this->applyEvent(new CardWasTurned($cardPosition, $card));

        if (count($this->turnedCards) === 1) {
            return;
        }

        list($firstCard, $secondCard) = $this->turnedCards;

        if (!$firstCard->matches($secondCard)) {
            return $this->applyEvent(new RoundWasLost);
        }

        if ($this->playingField->countCards() !== 2) {
            return $this->applyEvent(new RoundWasWon);
        }

        return $this->applyEvent(new GameWasWon($this->playSheet));
    }

    private function applyGameWasStarted(GameWasStarted $event)
    {
        $this->id = $event->id();
        $this->playingField = $event->playingField();
        $this->playSheet = new PlaySheet;
    }

    private function applyCardWasTurned(CardWasTurned $event)
    {
        $this->turnedCards[] = $event->card();
    }

    private function applyRoundWasLost(RoundWasLost $event)
    {
        $this->playSheet = $this->playSheet->record(PlaySheet::ODD);
        $this->turnedCards = array();
    }

    private function applyRoundWasWon(RoundWasWon $event)
    {
        while ($card = array_shift($this->turnedCards)) {
            $this->playingField->remove($card);
        }

        $this->playSheet = $this->playSheet->record(PlaySheet::MATCH);
    }

    private function applyGameWasWon(GameWasWon $event)
    {
        $this->applyRoundWasWon(new RoundWasWon);
    }
}
