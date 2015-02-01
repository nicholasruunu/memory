<?php

namespace Memory\Card;

interface Card
{
  /**
   * @param \Memory\Card\Card $card
   * @return bool
   */
  public function matches(Card $card);
}
