<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\Domain\ValueObject\LegendaryQuality;
use GildedRose\Domain\ValueObject\Quality;
use GildedRose\Domain\ValueObject\SellIn;
use PHPUnit\Framework\TestCase;

class ValueObjectTest extends TestCase
{
    public function testQualityValueObject(): void
    {
        $quality = new Quality(10);
        $this->assertEquals(10, $quality->getValue());

        $increasedQuality = $quality->increase(5);
        $this->assertEquals(15, $increasedQuality->getValue());

        $decreasedQuality = $quality->decrease(3);
        $this->assertEquals(7, $decreasedQuality->getValue());
    }

    public function testSellInValueObject(): void
    {
        $sellIn = new SellIn(5);
        $this->assertEquals(5, $sellIn->getDays());

        $decrementedSellIn = $sellIn->decrement();
        $this->assertEquals(4, $decrementedSellIn->getDays());

        $expiredSellIn = new SellIn(-1);
        $this->assertTrue($expiredSellIn->isExpired());
    }

    public function testQualityValueObjectThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Quality must be between 0 and 50.');

        new Quality(51);
    }

    public function testLegendaryItemQualityValueObject(): void
    {
        $quality = new LegendaryQuality(80);
        $this->assertEquals(80, $quality->getValue());

        $increasedQuality = $quality->increase(5);
        $this->assertEquals(80, $increasedQuality->getValue());

        $decreasedQuality = $quality->decrease(3);
        $this->assertEquals(80, $decreasedQuality->getValue());
    }
}