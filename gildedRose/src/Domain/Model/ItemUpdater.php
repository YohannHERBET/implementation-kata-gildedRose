<?php

namespace GildedRose\Domain\Model;

use GildedRose\Domain\ValueObject\Quality;
use GildedRose\Domain\ValueObject\SellIn;
use GildedRose\Domain\Model\Item;

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