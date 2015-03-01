<?php

namespace Memory\PlayingField;

use Memory\PlayingField;
use PhpSpec\Exception\Exception;
use RuntimeException;
use SplFileInfo;

final class DeckGenerator
{
    public function generate($cardRowLength)
    {
        $image_path = public_path('images/cards');
        $playingField = IncompletePlayingField::size($cardRowLength);

        for ($i = 1; get_class($playingField) !== PlayingField::class; $i++) {
            try {
                $card = new Card(new SplFileInfo($image_path . "/{$i}.png"));
            } catch (Exception $e) {
                throw new RuntimeException(
                    "There's not cards enough to make a row $cardRowLength playingField"
                );
            }

            $playingField = $playingField->putDownRandomly($card);
            $playingField = $playingField->putDownRandomly($card->copy());

        }

        return $playingField;
    }
}
