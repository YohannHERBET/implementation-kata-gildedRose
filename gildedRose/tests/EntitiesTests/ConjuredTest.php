<?php

declare(strict_types=1);

namespace Tests\EntitiesTests;

use PHPUnit\Framework\TestCase;

use GildedRose\GildedRose;
use GildedRose\Domain\Model\Item;

class ConjuredTest extends TestCase
{
    public function testConjuredDecreaseQualityTwiceAsFast(): void
    {
        $item = new Item('Conjured Mana Cake', 8, 10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(7, $item->sellIn);
        $this->assertEquals(8, $item->quality);
    }

    public function testConjuredDecreaseQualityTwiceAsFastWhenSellInIsNegative(): void
    {
        $item = new Item('Conjured Mana Cake', -1, 10);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(-2, $item->sellIn);
        $this->assertEquals(6, $item->quality);
    }

    public function testConjuredQualityIsNeverNegative(): void
    {
        $item = new Item('Conjured Mana Cake', 8, 0);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(7, $item->sellIn);
        $this->assertEquals(0, $item->quality);
    }
}