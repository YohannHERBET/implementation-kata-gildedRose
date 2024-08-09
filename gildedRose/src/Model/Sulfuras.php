<?php

namespace GildedRose\Model;

use GildedRose\Item;
use GildedRose\Model\ValueObject\LegendaryQuality;

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