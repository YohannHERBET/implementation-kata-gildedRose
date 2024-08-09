<?php

declare(strict_types=1);

namespace GildedRose\Domain\Model;
use GildedRose\Domain\Model\Interfaces\ItemInterface;

class Conjured extends Item implements ItemInterface
{
    public function update(): void
    {
        $this->decreaseQuality(2);
        $this->decreaseSellIn();

        if ($this->sellIn < 0) {
          $this->decreaseQuality(2);
        }
    }
}