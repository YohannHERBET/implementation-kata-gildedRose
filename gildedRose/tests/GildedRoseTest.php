<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\Model\ValueObject\Quality;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    private Item $singleItem;
    private array $items;
    private GildedRose $gildedRose;
    
    protected function setUp(): void
    {
        $this->singleItem = new Item('Aged Brie', 2, 2);

        $this->items = [
            new Item('+5 Dexterity Vest', 10, 20),
            new Item('Aged Brie', 2, 0),
            new Item('Elixir of the Mongoose', 5, 7),
            new Item('Sulfuras, Hand of Ragnaros', 0, 80),
            new Item('Sulfuras, Hand of Ragnaros', -1, 80),
            new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20),
            new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49),
            new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49),
            new Item('Conjured Mana Cake', 3, 6),
        ];
        
        $this->gildedRose = new GildedRose($this->items);
    }
    public function testUpdateQualityForTwoDays(): void
    {

        // Day 1
        $this->gildedRose->updateQuality();

        $this->assertEquals(9, $this->items[0]->sellIn);
        $this->assertEquals(19, $this->items[0]->quality);

        $this->assertEquals(1, $this->items[1]->sellIn);
        $this->assertEquals(1, $this->items[1]->quality);

        $this->assertEquals(4, $this->items[2]->sellIn);
        $this->assertEquals(6, $this->items[2]->quality);

        $this->assertEquals(0, $this->items[3]->sellIn);
        $this->assertEquals(80, $this->items[3]->quality);

        $this->assertEquals(-1, $this->items[4]->sellIn);
        $this->assertEquals(80, $this->items[4]->quality);

        $this->assertEquals(14, $this->items[5]->sellIn);
        $this->assertEquals(21, $this->items[5]->quality);

        $this->assertEquals(9, $this->items[6]->sellIn);
        $this->assertEquals(50, $this->items[6]->quality);

        $this->assertEquals(4, $this->items[7]->sellIn);
        $this->assertEquals(50, $this->items[7]->quality);

        $this->assertEquals(2, $this->items[8]->sellIn);
        $this->assertEquals(4, $this->items[8]->quality);

        // Day 2
        $this->gildedRose->updateQuality();

        $this->assertEquals(8, $this->items[0]->sellIn);
        $this->assertEquals(18, $this->items[0]->quality);

        $this->assertEquals(0, $this->items[1]->sellIn);
        $this->assertEquals(2, $this->items[1]->quality);

        $this->assertEquals(3, $this->items[2]->sellIn);
        $this->assertEquals(5, $this->items[2]->quality);

        $this->assertEquals(0, $this->items[3]->sellIn);
        $this->assertEquals(80, $this->items[3]->quality);

        $this->assertEquals(-1, $this->items[4]->sellIn);
        $this->assertEquals(80, $this->items[4]->quality);

        $this->assertEquals(13, $this->items[5]->sellIn);
        $this->assertEquals(22, $this->items[5]->quality);

        $this->assertEquals(8, $this->items[6]->sellIn);
        $this->assertEquals(50, $this->items[6]->quality);

        $this->assertEquals(3, $this->items[7]->sellIn);
        $this->assertEquals(50, $this->items[7]->quality);

        $this->assertEquals(1, $this->items[8]->sellIn);
        $this->assertEquals(2, $this->items[8]->quality);
    }

    public function testQualityDegradesTwiceAsFastAfterExpiration(): void
    {
        $items = [
            new Item('+5 Dexterity Vest 2', 0, 10),
            new Item('Elixir of the Mongoose 2', -1, 5),
            new Item('Conjured Mana Cake', 0, 10),
        ];

        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(-1, $items[0]->sellIn);
        $this->assertEquals(8, $items[0]->quality);

        $this->assertEquals(-2, $items[1]->sellIn);
        $this->assertEquals(3, $items[1]->quality);

        $this->assertEquals(-1, $items[2]->sellIn);
        $this->assertEquals(6, $items[2]->quality);
    }
}