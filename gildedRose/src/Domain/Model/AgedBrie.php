<?php

declare(strict_types=1);

namespace GildedRose\Domain\Model;
use GildedRose\Domain\Model\Interfaces\ItemInterface;

class AgedBrie extends Item implements ItemInterface
{
    public function update(): void
    {
        $this->quality = $this->quality->increase();
        $this->sellIn = $this->sellIn->decrement();
    }
}