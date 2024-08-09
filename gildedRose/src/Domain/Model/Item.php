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
        $this->sellIn -= 1;
    }

    public function increaseQuality(): void
    {
        if ($this->quality < 50) {
            $this->quality++;
        }
    }

    public function decreaseQuality(int $amount = 1): void
    {
        if ($this->quality > 0) {
            $this->quality -= $amount;
        }
    }
    public function __toString(): string
    {
        return (string) "{$this->name}, {$this->sellIn}, {$this->quality}";
    }
}