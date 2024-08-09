<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use GildedRose\GildedRose;
use GildedRose\Item;

class GildedRoseTest extends TestCase
{
    private array $item;
    private Item $singleItem;
    private GildedRose $gildedRose;
    
    protected function setUp(): void
    {
        $this->item = [
            new Item('foo', 8, 10),
            new Item('Aged Brie', 2, 0),
            new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20),
            new Item('Backstage passes to a TAFKAL80ETC concert', 10, 20),
            new Item('Sulfuras, Hand of Ragnaros', 0, 80),
            new Item('Sulfuras, Hand of Ragnaros', -1, 80),
            new Item('Conjured Mana Cake', 3, 0),
            new Item('Elixir of the Mongoose', 5, 7),
            new Item('+5 Dexterity Vest', 10, 20),
        ];

        $this->singleItem = new Item('foo', 8, 10);

        $this->gildedRose = new GildedRose($this->item);
    }
    public function testSystemWorksWellFor1Days(): void
    {
        $this->gildedRose->updateQuality();

        $this->assertEquals(7, $this->item[0]->sellIn);
        $this->assertEquals(9, $this->item[0]->quality);

        $this->assertEquals(1, $this->item[1]->sellIn);
        $this->assertEquals(1, $this->item[1]->quality);

        $this->assertEquals(14, $this->item[2]->sellIn);
        $this->assertEquals(21, $this->item[2]->quality);

        $this->assertEquals(9, $this->item[3]->sellIn);
        $this->assertEquals(22, $this->item[3]->quality);

        $this->assertEquals(0, $this->item[4]->sellIn);
        $this->assertEquals(80, $this->item[4]->quality);

        $this->assertEquals(-1, $this->item[5]->sellIn);
        $this->assertEquals(80, $this->item[5]->quality);
        
        $this->assertEquals(2, $this->item[6]->sellIn);
        $this->assertEquals(0, $this->item[6]->quality);

        $this->assertEquals(4, $this->item[7]->sellIn);
        $this->assertEquals(6, $this->item[7]->quality);

        $this->assertEquals(9, $this->item[8]->sellIn);
        $this->assertEquals(19, $this->item[8]->quality);
    }

    public function testDecreaseSellIn()
    {
        $this->gildedRose->decreaseSellIn($this->singleItem);

        $this->assertEquals(7, $this->singleItem->sellIn);
    }
}