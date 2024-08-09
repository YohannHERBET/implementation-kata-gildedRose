<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use GildedRose\GildedRose;

use GildedRose\Domain\Model\Item;

class AgedBrieTest extends TestCase
{
    public function testAgedBrieIncreaseQualityAndDecreaseSellIn(): void
    {
        $item = new Item('Aged Brie', 8, 10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(7, $item->sellIn);
        $this->assertEquals(11, $item->quality);
    }

    public function testAgedBrieIncreaseQualityWhenSellInIsNegative(): void
    {
        $item = new Item('Aged Brie', -1, 10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(-2, $item->sellIn);
        $this->assertEquals(11, $item->quality);
    }

    public function testAgedBrieQualityIsNeverMoreThanFifty(): void
    {
        $item = new Item('Aged Brie', 8, 50);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(7, $item->sellIn);
        $this->assertEquals(50, $item->quality);
    }
}