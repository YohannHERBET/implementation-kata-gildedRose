<?php

namespace GildedRose\Domain\Model;

class AgedBrie extends ItemUpdater
{
    public function update(): void
    {
        $this->increaseQuality();

        $this->decreaseSellIn();

        if ($this->sellIn->isExpired()) {
            $this->increaseQuality();
        }

        $this->syncItem();
    }
}