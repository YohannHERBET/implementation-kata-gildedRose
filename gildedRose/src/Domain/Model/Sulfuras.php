<?php

namespace GildedRose\Domain\Model;

use GildedRose\Domain\Model\Item;
use GildedRose\Domain\ValueObject\LegendaryQuality;

class Sulfuras extends ItemUpdater
{
    public function __construct(Item $item)
    {
        $this->item = $item;
        $this->quality = new LegendaryQuality($item->quality);
    }
    public function update(): void
    {
    }
}