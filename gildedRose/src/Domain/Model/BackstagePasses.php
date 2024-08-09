<?php

declare(strict_types=1);

namespace GildedRose\Domain\Model;
use GildedRose\Domain\Model\Interfaces\ItemInterface;

class BackstagePasses extends Item implements ItemInterface
{
    public function update(): void
    {
        $this->increaseQuality();

        if ($this->sellIn < 11) {
            $this->increaseQuality();
        }

        if ($this->sellIn < 6) {
            $this->increaseQuality();
        }

        $this->decreaseSellIn();

        if ($this->sellIn < 0) {
            $this->quality = 0;
        }
    }
}