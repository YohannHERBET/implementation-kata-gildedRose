<?php

namespace GildedRose;

use GildedRose\Item;
use GildedRose\Model\ItemUpdater;
use GildedRose\Model\AgedBrie;
use GildedRose\Model\BackstagePasses;
use GildedRose\Model\Conjured;
use GildedRose\Model\Sulfuras;
use GildedRose\Model\RegularItem;

class ItemUpdaterFactory
{
    public static function create(Item $item): ItemUpdater
    {
        return match ($item->name) {
            'Aged Brie' => new AgedBrie($item),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstagePasses($item),
            'Sulfuras, Hand of Ragnaros' => new Sulfuras($item),
            'Conjured Mana Cake' => new Conjured($item),
            default => new RegularItem($item),
        };
    }
}