<?php

declare(strict_types=1);

namespace GildedRose\Domain\Model\Interfaces;

interface ItemInterface
{
    public function decreaseSellIn(): void;
    public function increaseQuality(): void;
    public function decreaseQuality(): void;
    public function update(): void;
}