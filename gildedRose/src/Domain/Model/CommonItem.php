<?php

declare(strict_types=1);

namespace GildedRose\Domain\Model;
use GildedRose\Domain\Model\Interfaces\ItemInterface;

class CommonItem extends Item implements ItemInterface
{
    public function update(): void
    {
        $this->sellIn = $this->sellIn->decrement();
        $this->quality = $this->quality->decrease(1);
        
        if ($this->sellIn->getDays() < 0) {
            $this->quality = $this->quality->decrease(1);
        }
    }
}