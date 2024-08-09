<?php

declare(strict_types=1);

namespace GildedRose\Domain\ValueObject;

class Quality
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value < 0 || $value > 50) {
            throw new \InvalidArgumentException('Quality must be between 0 and 50.');
        }
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function increase(int $amount): Quality
    {
        return new Quality(min(50, $this->value + $amount));
    }

    public function decrease(int $amount): Quality
    {
        return new Quality(max(0, $this->value - $amount));
    }
}