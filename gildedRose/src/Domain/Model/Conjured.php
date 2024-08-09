<?php

namespace GildedRose\Domain\Model;

class Conjured extends ItemUpdater
{
    public function update(): void
    {
        if ($this->quality->getValue() > 0) {
            $this->quality = $this->quality->decrease(2);
        }

        $this->sellIn = $this->sellIn->decrement();

        if ($this->sellIn->isExpired()) {
            if ($this->quality->getValue() > 0) {
                $this->quality = $this->quality->decrease(2);
            }
        }

        $this->syncItem();
    }
}