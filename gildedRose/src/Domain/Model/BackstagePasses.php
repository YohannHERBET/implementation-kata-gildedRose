<?php

declare(strict_types=1);

namespace GildedRose\Domain\Model;
use GildedRose\Domain\Model\Interfaces\ItemInterface;
use GildedRose\Domain\Model\Item;
use GildedRose\Domain\Model\ValueObjects\Quality;

class BackstagePasses extends Item implements ItemInterface
{
    public function update(): void
    {
        $this->quality = $this->quality->increase();
                
        if ($this->sellIn->getDays() < 11) {
            $this->quality = $this->quality->increase();
        }

        if ($this->sellIn->getDays() < 6) {
            $this->quality = $this->quality->increase();
        }

        $this->sellIn = $this->sellIn->decrement();

        if ($this->sellIn->getDays() < 0) {
            $this->quality = new Quality(0);
        }
    }
}