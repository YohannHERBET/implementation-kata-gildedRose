<?php

declare(strict_types=1);

namespace Tests\EntitiesTests;

use PHPUnit\Framework\TestCase;

use GildedRose\GildedRose;
use GildedRose\Domain\Model\Item;
use GildedRose\Domain\Model\ValueObjects\SellIn;
use GildedRose\Domain\Model\ValueObjects\Quality;

class ConjuredTest extends TestCase
{
    public function testConjuredDecreaseQualityTwiceAsFast(): void
    {
        $item = new Item('Conjured Mana Cake', new SellIn(8), new Quality(10));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(7, $item->sellIn->getDays());
        $this->assertEquals(8, $item->quality->getValue());
    }

    public function testConjuredDecreaseQualityTwiceAsFastWhenSellInIsNegative(): void
    {
        $item = new Item('Conjured Mana Cake', new SellIn(-1), new Quality(10));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(-2, $item->sellIn->getDays());
        $this->assertEquals(6, $item->quality->getValue());
    }

    public function testConjuredQualityIsNeverNegative(): void
    {
        $item = new Item('Conjured Mana Cake', new SellIn(8), new Quality(0));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(7, $item->sellIn->getDays());
        $this->assertEquals(0, $item->quality->getValue());
    }
}