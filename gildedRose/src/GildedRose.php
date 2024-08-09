<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Service\ItemUpdaterFactory;

final class GildedRose
{
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $updater = ItemUpdaterFactory::create($item);
            $updater->update();
        }
    }
}