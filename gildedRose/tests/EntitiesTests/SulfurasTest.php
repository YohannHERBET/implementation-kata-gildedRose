<?php

declare(strict_types=1);

namespace Tests\EntitiesTests;

use PHPUnit\Framework\TestCase;

use GildedRose\GildedRose;

use GildedRose\Domain\Model\Item;
use GildedRose\Domain\Model\ValueObjects\SellIn;
use GildedRose\Domain\Model\ValueObjects\Quality;
use GildedRose\Domain\Model\ValueObjects\LegendaryQuality;

class SulfurasTest extends TestCase
{
    public function testSulfurasNeverDecreaseQualityAndSellIn(): void
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', new SellIn(8), new LegendaryQuality(80));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(8, $item->sellIn->getDays());
        $this->assertEquals(80, $item->quality->getValue());
    }

    public function testSulfurasNeverDecreaseQualityAndSellInEvenWhenSellInIsNegative(): void
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', new SellIn(-1), new LegendaryQuality(80));
        $gildedRose = new GildedRose([$item]);

        $gildedRose->updateQuality();

        $this->assertEquals(-1, $item->sellIn->getDays());
        $this->assertEquals(80, $item->quality->getValue());
    }
}