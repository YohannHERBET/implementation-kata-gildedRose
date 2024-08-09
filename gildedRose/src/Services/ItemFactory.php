<?php 

declare(strict_types=1);

namespace GildedRose\Services;

use GildedRose\Domain\Model\Item;
use GildedRose\Domain\Model\CommonItem;

class ItemFactory
{
    public static function createItem(string $name, int $sellIn, int $quality): Item
    {
        switch ($name) {
            default:
                return new CommonItem($name, $sellIn, $quality);
        }
    }
}