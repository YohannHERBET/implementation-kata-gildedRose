<?php

namespace GildedRose\Model;

use GildedRose\Model\ValueObject\Quality;

class BackstagePasses extends ItemUpdater
{
    public function update(): void
    {
        if ($this->quality->getValue() < 50) {
            $this->quality = $this->quality->increase(1);

            if ($this->sellIn->getDays() < 11) {
                if ($this->quality->getValue() < 50) {
                    $this->quality = $this->quality->increase(1);
                }
            }
            if ($this->sellIn->getDays() < 6) {
                if ($this->quality->getValue() < 50) {
                    $this->quality = $this->quality->increase(1);
                }
            }
        }

        $this->sellIn = $this->sellIn->decrement();

        if ($this->sellIn->isExpired()) {
            $this->quality = new Quality(0);
        }

        $this->syncItem();
    }
}