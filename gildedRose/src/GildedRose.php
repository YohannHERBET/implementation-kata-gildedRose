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
            $commonItem = ItemFactory::createItem($item);
            $commonItem->update();
            $item->sellIn = $commonItem->sellIn;
            $item->quality = $commonItem->quality;
        }
    }
}