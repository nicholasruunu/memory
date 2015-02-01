<?php

namespace Memory\Card;

use SplFileInfo;

class Card
{
    private $image;

    /**
     * @param \SplFileInfo $image
     */
    public function __construct(SplFileInfo $image)
    {
        $this->image = $image;
    }

    /**
     * @param \Memory\Card\Card $card
     * @return bool
     */
    public function matches(Card $card)
    {
        return $card->getImage() === $this->getImage();
    }

    /**
     * @return string $image real path of image
     */
    public function getImage()
    {
        return $this->image->getRealPath();
    }
}
