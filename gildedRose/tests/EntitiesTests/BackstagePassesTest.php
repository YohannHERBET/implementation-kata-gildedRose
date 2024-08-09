<?php

declare(strict_types=1);

namespace Tests\EntitiesTests;

use PHPUnit\Framework\TestCase;

use GildedRose\GildedRose;

use GildedRose\Domain\Model\Item;

class BackstagePasses extends TestCase
{
    public function testBackstagePassesIncreaseQualityAndDecreaseSellIn(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 14, 10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(13, $item->sellIn);
        $this->assertEquals(11, $item->quality);
    }

    public function testBackstagePassesIncreaseQualityTwiceAsFastWhenSellInIsLessThanTen(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 9, 10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(8, $item->sellIn);
        $this->assertEquals(12, $item->quality);
    }

    public function testBackstagePassesIncreaseQualityThriceAsFastWhenSellInIsLessThanFive(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 4, 10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(3, $item->sellIn);
        $this->assertEquals(13, $item->quality);
    }

    public function testBackstagePassesQualityIsZeroWhenSellInIsNegative(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 0, 10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(-1, $item->sellIn);
        $this->assertEquals(0, $item->quality);
    }
    
    public function testBackstagePassesQualityIsNeverMoreThanFifty(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 8, 50);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(7, $item->sellIn);
        $this->assertEquals(50, $item->quality);
    }
}