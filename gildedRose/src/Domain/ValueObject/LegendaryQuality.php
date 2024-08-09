<?php

declare(strict_types=1);

namespace GildedRose\Domain\ValueObject;

class LegendaryQuality extends Quality
{
    private int $value;
    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('Quality must be non-negative.');
        }
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function increase(int $amount): LegendaryQuality
    {
        return new LegendaryQuality($this->value);
    }

    public function decrease(int $amount): LegendaryQuality
    {
        return new LegendaryQuality($this->value);
    }
}