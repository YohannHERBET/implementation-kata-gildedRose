<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use GildedRose\GildedRose;
use GildedRose\Domain\Model\Item;
use GildedRose\Domain\Model\ValueObjects\SellIn;
use GildedRose\Domain\Model\ValueObjects\Quality;
use GildedRose\Domain\Model\ValueObjects\LegendaryQuality;

class GildedRoseTest extends TestCase
{
    private array $item;
    private Item $singleItem;
    private GildedRose $gildedRose;
    
    protected function setUp(): void
    {
        $this->item = [
            new Item('foo', new SellIn(8), new Quality(10)),
            new Item('Aged Brie', new SellIn(2), new Quality(0)),
            new Item('Backstage passes to a TAFKAL80ETC concert', new SellIn(15), new Quality(20)),
            new Item('Backstage passes to a TAFKAL80ETC concert', new SellIn(10), new Quality(20)),
            new Item('Sulfuras, Hand of Ragnaros', new SellIn(0), new LegendaryQuality(80)),
            new Item('Sulfuras, Hand of Ragnaros', new SellIn(-1), new LegendaryQuality(80)),
            new Item('Conjured Mana Cake', new SellIn(3), new Quality(0)),
            new Item('Elixir of the Mongoose', new SellIn(5), new Quality(7)),
            new Item('+5 Dexterity Vest', new SellIn(10), new Quality(20)),
        ];

        $this->singleItem = new Item('foo', new SellIn(8), new Quality(10));

        $this->gildedRose = new GildedRose($this->item);
    }
    public function testSystemWorksWellFor1Days(): void
    {
        $this->gildedRose->updateQuality();

        $this->assertEquals(7, $this->item[0]->sellIn->getDays());
        $this->assertEquals(9, $this->item[0]->quality->getValue());

        $this->assertEquals(1, $this->item[1]->sellIn->getDays());
        $this->assertEquals(1, $this->item[1]->quality->getValue());

        $this->assertEquals(14, $this->item[2]->sellIn->getDays());
        $this->assertEquals(21, $this->item[2]->quality->getValue());

        $this->assertEquals(9, $this->item[3]->sellIn->getDays());
        $this->assertEquals(22, $this->item[3]->quality->getValue());

        $this->assertEquals(0, $this->item[4]->sellIn->getDays());
        $this->assertEquals(80, $this->item[4]->quality->getValue());

        $this->assertEquals(-1, $this->item[5]->sellIn->getDays());
        $this->assertEquals(80, $this->item[5]->quality->getValue());
        
        $this->assertEquals(2, $this->item[6]->sellIn->getDays());
        $this->assertEquals(0, $this->item[6]->quality->getValue());

        $this->assertEquals(4, $this->item[7]->sellIn->getDays());
        $this->assertEquals(6, $this->item[7]->quality->getValue());

        $this->assertEquals(9, $this->item[8]->sellIn->getDays());
        $this->assertEquals(19, $this->item[8]->quality->getValue());
    }
}