<?php

declare(strict_types=1);

namespace GildedRose;

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
            if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                $this->decreaseQuality($item);
            } else {
                $this->increaseQuality($item);
            }

            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                $item->sellIn = $item->sellIn - 1;
            }

            if ($item->sellIn < 0) {
                $this->handleExpiredItem($item);
            }
        }
    }
    public function increaseQuality(Item $item): void
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;

            if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->sellIn < 11) {
                    $this->increaseQuality($item);
                }
                if ($item->sellIn < 6) {
                    $this->increaseQuality($item);
                }
            }
        }
    }

    public function decreaseQuality(Item $item): void
    {
        if ($item->quality > 0 && $item->name != 'Sulfuras, Hand of Ragnaros') {
            $item->quality = $item->quality - 1;
        }
    }

    public function handleExpiredItem(Item $item): void
    {
        if ($item->name != 'Aged Brie') {
            if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                $this->decreaseQuality($item);
                if ($item->name == 'Conjured Mana Cake') {
                    $this->decreaseQuality($item);
                    $this->decreaseQuality($item);
                }
            } else {
                $item->quality = 0;
            }
        } else {
            if ($item->quality < 50) {
                $item->quality++;
            }
        }
    }
}