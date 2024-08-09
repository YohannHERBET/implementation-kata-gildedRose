<?php

declare(strict_types=1);

namespace Tests\EntitiesTests;

use PHPUnit\Framework\TestCase;

use GildedRose\GildedRose;
use GildedRose\Domain\Model\Item;
use GildedRose\Domain\Model\ValueObjects\SellIn;
use GildedRose\Domain\Model\ValueObjects\Quality;

class CommonItemTest extends TestCase
{
    public function testCommonItemDecreaseQualityAndSellIn(): void
    {
        $item = new Item('foo', new SellIn(8), new Quality(10));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(7, $item->sellIn->getDays());
        $this->assertEquals(9, $item->quality->getValue());
    }

    public function testCommonItemDecreaseQualityTwiceAsFastWhenSellInIsNegative(): void
    {
        $item = new Item('foo', new SellIn(-1), new Quality(10));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(-2, $item->sellIn->getDays());
        $this->assertEquals(8, $item->quality->getValue());
    }

    public function testCommonItemQualityIsNeverNegative(): void
    {
        $item = new Item('foo', new SellIn(8), new Quality(0));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(7, $item->sellIn->getDays());
        $this->assertEquals(0, $item->quality->getValue());
    }

    public function testCommonItemDecreaseSellInEvenWhenQualityIsZero(): void
    {
        $item = new Item('foo', new SellIn(8), new Quality(0));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(7, $item->sellIn->getDays());
        $this->assertEquals(0, $item->quality->getValue());
    }
}