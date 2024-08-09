<?php

namespace GildedRose\Model;

use GildedRose\Model\ValueObject\Quality;
use GildedRose\Model\ValueObject\SellIn;
use GildedRose\Item;

abstract class ItemUpdater
{
    protected Item $item;
    protected Quality $quality;
    protected SellIn $sellIn;

    public function __construct(Item $item)
    {
        $this->item = $item;
        $this->quality = new Quality($item->quality);
        $this->sellIn = new SellIn($item->sellIn);
    }

    abstract public function update(): void;

    protected function syncItem(): void
    {
        $this->item->quality = $this->quality->getValue();
        $this->item->sellIn = $this->sellIn->getDays();
    }
}