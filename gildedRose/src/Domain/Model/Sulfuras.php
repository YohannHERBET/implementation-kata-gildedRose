<?php

declare(strict_types=1);

namespace GildedRose\Domain\Model;
use GildedRose\Domain\Model\Interfaces\ItemInterface;
use GildedRose\Domain\Model\ValueObjects\LegendaryQuality;
use GildedRose\Domain\Model\ValueObjects\SellIn;

class Sulfuras extends Item implements ItemInterface
{
    public function __construct(
        string $name,
        SellIn $sellIn,
        LegendaryQuality $quality
    ) {
        parent::__construct($name, $sellIn, $quality);
    }

    public function update(): void
    {
    }
}