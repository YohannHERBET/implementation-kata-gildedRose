<?php

declare(strict_types=1);

namespace GildedRose\Model\ValueObject;

class SellIn
{
    private int $days;

    public function __construct(int $days)
    {
        $this->days = $days;
    }

    public function getDays(): int
    {
        return $this->days;
    }

    public function decrement(): SellIn
    {
        return new SellIn($this->days - 1);
    }

    public function isExpired(): bool
    {
        return $this->days < 0;
    }
}