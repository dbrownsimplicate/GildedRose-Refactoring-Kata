<?php

declare(strict_types=1);

namespace GildedRose\Inventory\Property;

class LegendaryQuality extends Quality
{
    public const LEGENDARY_QUALITY = 80;
    protected int $quality = self::LEGENDARY_QUALITY;

    public function __construct()
    {
        // Empty constructor since values shouldn't change for LegendaryQuality items
    }
}