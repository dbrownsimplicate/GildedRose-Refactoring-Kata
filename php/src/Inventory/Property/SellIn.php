<?php

declare(strict_types=1);

namespace GildedRose\Inventory\Property;

class SellIn
{
    private int $days;

    public function __construct(int $days)
    {
        $this->days = $days;
    }

    public function decrease(): void
    {
        $this->days--;
    }

    public function hasPassed(): bool
    {
        return 1 > $this->days;
    }

    public function getDaysInteger(): int
    {
        return $this->days;
    }
}