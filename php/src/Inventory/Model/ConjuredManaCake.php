<?php

declare(strict_types=1);

namespace GildedRose\Inventory\Model;

class ConjuredManaCake extends AbstractInventoryModel
{
    public const NAME = 'Conjured Mana Cake';
    protected int $qualityDegradation = 2;
}