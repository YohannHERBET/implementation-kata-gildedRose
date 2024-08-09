<?php

declare(strict_types=1);

namespace GildedRose\Domain\Model;
use GildedRose\Domain\Model\Interfaces\ItemInterface;

class Conjured extends Item implements ItemInterface
{
    public function update(): void
    {
        $this->quality = $this->quality->decrease(2);
        $this->sellIn = $this->sellIn->decrement();

        if ($this->sellIn->getDays() < 0) {
            $this->quality = $this->quality->decrease(2);
        }
    }
}