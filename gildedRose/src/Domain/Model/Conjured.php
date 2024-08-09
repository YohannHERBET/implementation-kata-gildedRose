<?php

declare(strict_types=1);

namespace GildedRose\Domain\Model;
use GildedRose\Domain\Model\Interfaces\ItemInterface;

class Conjured extends Item implements ItemInterface
{
    public function update(): void
    {
        $this->decreaseQuality();
        $this->decreaseQuality();
        $this->decreaseSellIn();

        if ($this->sellIn < 0) {
            $this->decreaseQuality();
            $this->decreaseQuality();
        }
    }
}