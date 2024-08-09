<?php 

declare(strict_types=1);

namespace GildedRose\Services;

use GildedRose\Domain\Model\Interfaces\ItemInterface;
use GildedRose\Domain\Model\Item;
use GildedRose\Domain\Model\CommonItem;

class ItemFactory
{
    public static function createItem(Item $item): ItemInterface
    {
        switch ($item->name) {
            default:
                return new CommonItem($item->name, $item->sellIn, $item->quality);
        }
    }
}