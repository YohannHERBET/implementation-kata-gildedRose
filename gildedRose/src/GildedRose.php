<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Domain\Model\Item;
use GildedRose\Domain\Model\ValueObjects\LegendaryQuality;
use GildedRose\Services\ItemFactory;
use GildedRose\Domain\Model\ValueObjects\SellIn;
use GildedRose\Domain\Model\ValueObjects\Quality;

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

            $item->sellIn = new SellIn($commonItem->sellIn->getDays());

            if ($commonItem->quality instanceOf LegendaryQuality) {
                $item->quality = new LegendaryQuality($item->quality->getValue());
            } else {
                $item->quality = new Quality($commonItem->quality->getValue());
            }
        }
    }
}