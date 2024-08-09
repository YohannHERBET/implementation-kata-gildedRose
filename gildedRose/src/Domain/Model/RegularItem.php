<?php

namespace GildedRose\Domain\Model;

class RegularItem extends ItemUpdater
{
    public function update(): void
    {
        $this->decreaseQuality();

        $this->sellIn = $this->sellIn->decrement();

        if ($this->sellIn->isExpired()) {
            $this->decreaseQuality();
        }

        $this->syncItem();
    }
}