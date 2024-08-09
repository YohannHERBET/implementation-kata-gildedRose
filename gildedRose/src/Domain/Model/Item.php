<?php

declare(strict_types=1);

namespace GildedRose\Domain\Model;

use GildedRose\Domain\Model\ValueObjects\SellIn;
use GildedRose\Domain\Model\ValueObjects\Quality;

class Item implements \Stringable
{
    public function __construct(
        public string $name,
        public SellIn $sellIn,
        public Quality $quality
    ) {}
    public function __toString(): string
    {
        return (string) "{$this->name}, {$this->sellIn->getDays()}, {$this->quality->getValue()}";
    }
}