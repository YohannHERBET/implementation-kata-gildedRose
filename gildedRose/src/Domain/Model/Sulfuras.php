<?php

declare(strict_types=1);

namespace GildedRose\Domain\Model;
use GildedRose\Domain\Model\Interfaces\ItemInterface;

class Sulfuras extends Item implements ItemInterface
{
    public function update(): void
    {
        // Sulfuras never has to be sold or decreases in quality
    }
}