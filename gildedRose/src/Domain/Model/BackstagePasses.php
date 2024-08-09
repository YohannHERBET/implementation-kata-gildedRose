<?php

namespace GildedRose\Domain\Model;

use GildedRose\Domain\ValueObject\Quality;

class BackstagePasses extends ItemUpdater
{
    public function update(): void
    {
        $this->increaseQuality();
        $this->adjustQualityForUpcomingConcert();

        $this->decreaseSellIn();

        if ($this->sellIn->isExpired()) {
            $this->resetQuality();
        }

        $this->syncItem();
    }
    private function adjustQualityForUpcomingConcert(): void
    {
        if ($this->sellIn->getDays() < 11) {
            $this->increaseQuality();
        }
        if ($this->sellIn->getDays() < 6) {
            $this->increaseQuality();
        }
    }

    private function resetQuality(): void
    {
        $this->quality = new Quality(0);
    }
}