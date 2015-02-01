<?php

namespace spec\Memory\Deck;

use Memory\Deck\Card;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SplFileInfo;
use Symfony\Component\Filesystem\Filesystem;

class CardSpec extends ObjectBehavior
{
    function let()
    {
        $fs = new Filesystem();
        $fs->touch('/tmp/image.png');
        $fs->touch('/tmp/another_image.png');
        $image = new SplfileInfo('/tmp/image.png');
        $this->beConstructedWith($image);
    }

    function it_matches_another_card_with_same_image()
    {
        $image = new SplFileInfo('/tmp/image.png');
        $card = new Card($image);
        $this->matches($card)->shouldReturn(true);
    }

    function it_does_not_match_card_with_another_image()
    {
        $image = new SplFileInfo('/tmp/another_image.png');
        $card = new Card($image);
        $this->matches($card)->shouldReturn(false);
    }

    function it_returns_real_path_to_the_image()
    {
        $realPath = realpath('/tmp/image.png');
        $this->getImage()->shouldReturn($realPath);
    }
}
