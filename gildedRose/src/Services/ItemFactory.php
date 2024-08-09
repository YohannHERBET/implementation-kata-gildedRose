<?php 

declare(strict_types=1);

namespace GildedRose\Services;

use GildedRose\Domain\Model\Interfaces\ItemInterface;
use GildedRose\Domain\Model\Item;
use GildedRose\Domain\Model\CommonItem;
use GildedRose\Domain\Model\AgedBrie;
use GildedRose\Domain\Model\Sulfuras;
use GildedRose\Domain\Model\BackstagePasses;

class ItemFactory
{
    public static function createItem(Item $item): ItemInterface
    {
        return match ($item->name) {
            'Backstage passes to a TAFKAL80ETC concert' => new BackstagePasses($item->name, $item->sellIn, $item->quality),
            'Sulfuras, Hand of Ragnaros' => new Sulfuras($item->name, $item->sellIn, $item->quality),
            'Aged Brie' => new AgedBrie($item->name, $item->sellIn, $item->quality),
            default => new CommonItem($item->name, $item->sellIn, $item->quality),
        };
    }
}