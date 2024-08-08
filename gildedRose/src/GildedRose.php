<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Model\ValueObject\Quality;
use GildedRose\Model\ValueObject\SellIn;

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

            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                $sellIn = new SellIn($item->sellIn);
                $quality = new Quality($item->quality);
                
                if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                    $quality = $this->decreaseQuality($item, $quality);
                } else {
                    $quality = $this->increaseQuality($item, $quality);
                }

                $sellIn = $sellIn->decrement();

                if ($sellIn->getDays() < 0) {
                    $quality = $this->handleExpiredItem($item, $quality);
                }
                $this->syncItem($item, $sellIn, $quality);
            }
        }
    }
    public function increaseQuality(Item $item, Quality $quality): Quality
    {
        if ($quality->getValue() < 50) {
            $quality = $quality->increase(1);

            if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->sellIn < 11) {
                    $quality = $quality->increase(1);
                }
                if ($item->sellIn < 6) {
                    $quality = $quality->increase(1);
                }
            }
        }

        return $quality;
    }

    public function decreaseQuality(Item $item, Quality $quality): Quality
    {
        if ($quality->getValue() > 0 && $item->name != 'Sulfuras, Hand of Ragnaros') {
            $decrement = 1;

            if ($item->name == 'Conjured Mana Cake') {
                $decrement *= 2;
            }

            $quality = $quality->decrease($decrement);
        }

        return $quality;
    }

    public function handleExpiredItem(Item $item, Quality $quality): Quality
    {
        if ($item->name != 'Aged Brie') {
            if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                $quality = $this->decreaseQuality($item, $quality);
            } else {
                $quality = new Quality(0);
            }
        } else {
            if ($quality->getValue() < 50) {
                $quality = $quality->increase(1);
            }
        }

        return $quality;
    }

    public function syncItem(Item $item, SellIn $sellIn, Quality $quality): void
    {
        $item->sellIn = $sellIn->getDays();
        $item->quality = $quality->getValue();
    }
}