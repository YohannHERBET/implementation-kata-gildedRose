<?php

namespace GildedRose\Model;

class AgedBrie extends ItemUpdater
{
    public function update(): void
    {
        if ($this->quality->getValue() < 50) {
            $this->quality = $this->quality->increase(1);
        }

        $this->sellIn = $this->sellIn->decrement();

        if ($this->sellIn->isExpired()) {
            if ($this->quality->getValue() < 50) {
                $this->quality = $this->quality->increase(1);
            }
        }

        $this->syncItem();
    }
}