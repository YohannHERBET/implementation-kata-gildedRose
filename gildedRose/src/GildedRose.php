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
            // si le nom de l'item n'est pas "Aged Brie" et n'est pas "Backstage passes to a TAFKAL80ETC concert"
            if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                // et que la qualité de l'item est supérieure à 0
                if ($item->quality > 0) {
                    // et que le nom de l'item n'est pas "Sulfuras, Hand of Ragnaros"
                    if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                        // alors la qualité de l'item est décrémentée
                        $item->quality = $item->quality - 1;
                    }
                }
            } else {
                // sinon
                // si la qualité de l'item est inférieure à 50
                // alors la qualité de l'item est incrémentée
                $this->increaseQuality($item);
                // si le nom de l'item est "Backstage passes to a TAFKAL80ETC concert"
                if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                    // et que les jours restants pour vendre l'item sont inférieurs à 11
                    if ($item->sellIn < 11) {
                        // et que la qualité de l'item est inférieure à 50
                        $this->increaseQuality($item);
                    }
                    // si les jours restants pour vendre l'item sont inférieurs à 6
                    if ($item->sellIn < 6) {
                        // et que la qualité de l'item est inférieure à 50
                        $this->increaseQuality($item);
                    }
                }
            }

            // si le nom de l'item n'est pas "Sulfuras, Hand of Ragnaros"
            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                // alors les jours restants pour vendre l'item sont décrémentés
                $item->sellIn = $item->sellIn - 1;
            }

            // si les jours restants pour vendre l'item sont inférieurs à 0
            if ($item->sellIn < 0) {
                // et que le nom de l'item n'est pas "Aged Brie"
                if ($item->name != 'Aged Brie') {
                    // et que le nom de l'item n'est pas "Backstage passes to a TAFKAL80ETC concert"
                    if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                        // et que la qualité de l'item est supérieure à 0
                        if ($item->quality > 0) {
                            // et que le nom de l'item n'est pas "Sulfuras, Hand of Ragnaros"
                            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                                // alors la qualité de l'item est décrémentée
                                $item->quality = $item->quality - 1;
                            }
                        }
                    } else {
                        // sinon
                        // la qualité de l'item est décrémentée
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    // sinon
                    // si la qualité de l'item est inférieure à 50
                    $this->increaseQuality($item);
                }
            }
        }
    }
    public function increaseQuality(Item $item): void
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;
        }
    }
}