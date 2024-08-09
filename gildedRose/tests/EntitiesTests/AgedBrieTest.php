<?php

declare(strict_types=1);

namespace Tests\EntitiesTests;

use PHPUnit\Framework\TestCase;

use GildedRose\GildedRose;

use GildedRose\Domain\Model\Item;
use GildedRose\Domain\Model\ValueObjects\SellIn;
use GildedRose\Domain\Model\ValueObjects\Quality;

class AgedBrieTest extends TestCase
{
    public function testAgedBrieIncreaseQualityAndDecreaseSellIn(): void
    {
        $item = new Item('Aged Brie', new SellIn(8), new Quality(10));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(7, $item->sellIn->getDays());
        $this->assertEquals(11, $item->quality->getValue());
    }

    public function testAgedBrieIncreaseQualityWhenSellInIsNegative(): void
    {
        $item = new Item('Aged Brie', new SellIn(-1), new Quality(10));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(-2, $item->sellIn->getDays());
        $this->assertEquals(11, $item->quality->getValue());
    }

    public function testAgedBrieQualityIsNeverMoreThanFifty(): void
    {
        $item = new Item('Aged Brie', new SellIn(8), new Quality(50));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(7, $item->sellIn->getDays());
        $this->assertEquals(50, $item->quality->getValue());
    }
}