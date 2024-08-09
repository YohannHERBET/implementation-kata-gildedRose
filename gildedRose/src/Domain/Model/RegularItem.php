<?php

namespace GildedRose\Domain\Model;

class RegularItem extends ItemUpdater
{
    public function update(): void
    {
        if ($this->quality->getValue() > 0) {
            $this->quality = $this->quality->decrease(1);
        }

        $this->sellIn = $this->sellIn->decrement();

        if ($this->sellIn->isExpired() && $this->quality->getValue() > 0) {
            $this->quality = $this->quality->decrease(1);
        }

        $this->syncItem();
    }
}