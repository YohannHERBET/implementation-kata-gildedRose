<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use GildedRose\GildedRose;
use GildedRose\Domain\Model\Item;

class CommonItemTest extends TestCase
{
    public function testCommonItemDecreaseQualityAndSellIn(): void
    {
        $item = new Item('foo', 8, 10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(7, $item->sellIn);
        $this->assertEquals(9, $item->quality);
    }

    public function testCommonItemDecreaseQualityTwiceAsFastWhenSellInIsNegative(): void
    {
        $item = new Item('foo', -1, 10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(-2, $item->sellIn);
        $this->assertEquals(8, $item->quality);
    }

    public function testCommonItemQualityIsNeverNegative(): void
    {
        $item = new Item('foo', 8, 0);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(7, $item->sellIn);
        $this->assertEquals(0, $item->quality);
    }

    public function testCommonItemDecreaseSellInEvenWhenQualityIsZero(): void
    {
        $item = new Item('foo', 8, 0);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(7, $item->sellIn);
        $this->assertEquals(0, $item->quality);
    }
}