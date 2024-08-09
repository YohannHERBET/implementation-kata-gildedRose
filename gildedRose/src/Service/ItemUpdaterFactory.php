<?php

namespace GildedRose\Service;

use GildedRose\Domain\Model\Item;
use GildedRose\Domain\Model\ItemUpdater;
use GildedRose\Domain\Model\AgedBrie;
use GildedRose\Domain\Model\BackstagePasses;
use GildedRose\Domain\Model\Conjured;
use GildedRose\Domain\Model\Sulfuras;
use GildedRose\Domain\Model\RegularItem;

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