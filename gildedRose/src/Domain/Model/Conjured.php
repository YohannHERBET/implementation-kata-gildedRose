<?php

namespace GildedRose\Domain\Model;

class Conjured extends ItemUpdater
{
    public function update(): void
    {
        $this->decreaseQuality(2);
    
        $this->decreaseSellIn();
    
        if ($this->sellIn->isExpired()) {
            $this->decreaseQuality(2);
        }
    
        $this->syncItem();
    }
}