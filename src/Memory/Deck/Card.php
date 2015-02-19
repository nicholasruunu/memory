<?php

namespace Memory\Deck;

use Exception;

final class Card
{
    private $imagePath;

    /**
     * @param $imagePath
     * @throws Exception
     */
    public function __construct($imagePath)
    {
        $imagePath = realpath($imagePath);

        if (!is_file($imagePath)) {
            throw new Exception("File at {$imagePath} does not exist.");
        }

        $this->imagePath = $imagePath;
    }

    /**
     * @param \Memory\Deck\Card $card
     * @return bool
     */
    public function matches(Card $card)
    {
        return $this->getImage() === $card->image();
    }

    public function copy()
    {
        return new static($this->imagePath);
    }

    /**
     * @return string $image Real path of image
     */
    public function image()
    {
        return $this->imagePath;
    }
}
