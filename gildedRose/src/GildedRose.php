<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Domain\Model\Item;
use GildedRose\Services\ItemFactory;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            if ($item->name != 'Conjured Mana Cake') {
                $commonItem = ItemFactory::createItem($item);
                $commonItem->update();
                $item->sellIn = $commonItem->sellIn;
                $item->quality = $commonItem->quality;
            } else {
                if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                        $this->decreaseQuality($item);
                    }
                } else {
                    
                    $this->increaseQuality($item);
                    
                    if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->sellIn < 11) {
                            $this->increaseQuality($item);
                        }
                        if ($item->sellIn < 6) {
                            $this->increaseQuality($item);
                        }
                    }
                }

                $this->decreaseSellIn($item);

                if ($item->sellIn < 0) {
                    if ($item->name != 'Aged Brie') {
                        if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                            if ($item->quality > 0) {
                                $this->decreaseSellIn($item);
                            }
                        } else {
                            $item->quality = $item->quality - $item->quality;
                        }
                    } else {
                        $this->increaseQuality($item);
                    }
                }
            }
        }
    }
    public function decreaseSellIn(Item $item): void
    {
        if ($item->name != 'Sulfuras, Hand of Ragnaros') {
            $item->sellIn = $item->sellIn - 1;
        }
    }

    public function increaseQuality(Item $item): void
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;
        }
    }

    public function decreaseQuality(Item $item): void
    {
        if ($item->quality > 0) {
            $item->quality = $item->quality - 1;
        }
    }
}