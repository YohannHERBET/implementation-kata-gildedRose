<?php

declare(strict_types=1);

namespace GildedRose\Domain\Model;
use GildedRose\Domain\Model\Interfaces\ItemInterface;

class CommonItem extends Item implements ItemInterface
{
    public function update(): void
    {
        $this->decreaseSellIn();
        $this->decreaseQuality();
        
        if ($this->sellIn < 0) {
            $this->decreaseQuality();
        }
    }
}