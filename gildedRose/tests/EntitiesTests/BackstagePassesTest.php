<?php

declare(strict_types=1);

namespace Tests\EntitiesTests;

use PHPUnit\Framework\TestCase;

use GildedRose\GildedRose;

use GildedRose\Domain\Model\Item;
use GildedRose\Domain\Model\ValueObjects\SellIn;
use GildedRose\Domain\Model\ValueObjects\Quality;

class BackstagePasses extends TestCase
{
    public function testBackstagePassesIncreaseQualityAndDecreaseSellIn(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', new SellIn(14), new Quality(10));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(13, $item->sellIn->getDays());
        $this->assertEquals(11, $item->quality->getValue());
    }

    public function testBackstagePassesIncreaseQualityTwiceAsFastWhenSellInIsLessThanTen(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', new SellIn(9), new Quality(10));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(8, $item->sellIn->getDays());
        $this->assertEquals(12, $item->quality->getValue());
    }

    public function testBackstagePassesIncreaseQualityThriceAsFastWhenSellInIsLessThanFive(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', new SellIn(4), new Quality(10));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(3, $item->sellIn->getDays());
        $this->assertEquals(13, $item->quality->getValue());
    }

    public function testBackstagePassesQualityIsZeroWhenSellInIsNegative(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', new SellIn(0), new Quality(10));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(-1, $item->sellIn->getDays());
        $this->assertEquals(0, $item->quality->getValue());
    }
    
    public function testBackstagePassesQualityIsNeverMoreThanFifty(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', new SellIn(8), new Quality(50));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(7, $item->sellIn->getDays());
        $this->assertEquals(50, $item->quality->getValue());
    }
}