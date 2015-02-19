<?php

namespace Memory\Deck;

use SplFileInfo;

final class DeckGenerator
{
    public function generate($deckSquareLength)
    {
        $cards = new CardCollection;
        $image_path = public_path('images/cards');
        $uniqueCardAmount = $deckSquareLength ^ 2 / 2;

        foreach (range(1, $uniqueCardAmount) as $index) {
            $card = new Card(new SplFileInfo($image_path . "/{$index}.png"));
            $cards->add($card);
            $cards->add($card->copy());
        }

        // Shuffle cards
        $cards->shuffle();

        return new Deck($cards);
    }
}
