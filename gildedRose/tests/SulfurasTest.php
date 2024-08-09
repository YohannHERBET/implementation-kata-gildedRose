<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use GildedRose\GildedRose;

use GildedRose\Domain\Model\Item;

class SulfurasTest extends TestCase
{
    public function testSulfurasNeverDecreaseQualityAndSellIn(): void
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', 8, 80);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(8, $item->sellIn);
        $this->assertEquals(80, $item->quality);
    }

    public function testSulfurasNeverDecreaseQualityAndSellInEvenWhenSellInIsNegative(): void
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', -1, 80);
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(-1, $item->sellIn);
        $this->assertEquals(80, $item->quality);
    }
}