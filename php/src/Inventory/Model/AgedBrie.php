<?php

declare(strict_types=1);

namespace GildedRose\Inventory\Model;

class AgedBrie extends AbstractInventoryModel
{
    public const NAME = 'Aged Brie';
    protected int $qualityDegradation = -1;
}