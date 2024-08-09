<?php

declare(strict_types=1);

namespace GildedRose\Tests;

use GildedRose\Domain\Model\Item;
use GildedRose\Domain\Model\CommonItem;
use GildedRose\Services\ItemFactory;
use PHPUnit\Framework\TestCase;
use GildedRose\Domain\Model\ValueObjects\SellIn;
use GildedRose\Domain\Model\ValueObjects\Quality;

final class FactoryTest extends TestCase
{
    public function testCreateItem(): void
    {
        $singleItem = new Item('foo', new SellIn(1), new Quality(2));
        $item = ItemFactory::createItem($singleItem);
        $this->assertInstanceOf(Item::class, $item);
        $this->assertInstanceOf(CommonItem::class, $item);
    }
}