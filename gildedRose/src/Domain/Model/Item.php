<?php

declare(strict_types=1);

namespace GildedRose\Domain\Model;

class Item implements \Stringable
{
    public function __construct(
        public string $name,
        public int $sellIn,
        public int $quality
    ) {
    }

    public function decreaseSellIn(): void
    {
        if ($this->name != 'Sulfuras, Hand of Ragnaros') {
            $this->sellIn = $this->sellIn - 1;
        }
    }

    public function increaseQuality(): void
    {
        if ($this->quality < 50) {
            $this->quality = $this->quality + 1;
        }
    }

    public function decreaseQuality(): void
    {
        if ($this->quality > 0) {
            $this->quality = $this->quality - 1;
        }
    }
    public function __toString(): string
    {
        return (string) "{$this->name}, {$this->sellIn}, {$this->quality}";
    }
}