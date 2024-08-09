<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use GildedRose\Service\ItemUpdaterFactory;
use GildedRose\Domain\Model\Item;
use GildedRose\Domain\Model\RegularItem;

class FactoryTest extends TestCase
{
    public function testCreateAEntityWithTheFactory(): void
    {
        $commonItem = new Item('+5 Dexterity Vest 2', 3, 10);
        $item = ItemUpdaterFactory::create($commonItem);
        $this->assertInstanceOf(RegularItem::class, $item);
    }  
}