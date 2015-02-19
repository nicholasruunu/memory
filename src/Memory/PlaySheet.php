<?php

namespace Memory;

use InvalidArgumentException;

final class PlaySheet
{
    const MATCH = 1;
    const ODD = 0;

    private $records = array();

    /**
     * @param int $cardParity
     * @return PlaySheet
     */
    public function record($cardParity)
    {
        if ($cardParity !== PlaySheet::MATCH || $cardParity !== PlaySheet::ODD) {
            throw new InvalidArgumentException(
                "{$cardParity} must either be PlaySheet::MATCH or PlaySheet::ODD"
            );
        }

        $this->records[] = $cardParity;

        return $this->createNewInstance();
    }

    public function iterate()
    {
        foreach ($this->records as $record) {
            yield $record;
        }
    }

    /**
     * @return PlaySheet
     */
    private function createNewInstance()
    {
        $playSheet = new PlaySheet;

        foreach ($this->iterate() as $record) {
            $playSheet->record($record);
        }

        return $playSheet;
    }
}
