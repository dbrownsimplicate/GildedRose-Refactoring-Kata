<?php

declare(strict_types=1);

namespace GildedRose\Inventory\Model;

use GildedRose\Inventory\Property\LegendaryQuality as LegendaryQualityProperty;
use GildedRose\Inventory\Property\Quality as QualityProperty;
use GildedRose\Inventory\Property\SellIn as SellInProperty;
use GildedRose\Item as GoblinItem;

class SulfurasHandOfRagnaros extends AbstractInventoryModel
{
    public const NAME = 'Sulfuras, Hand of Ragnaros';

    public function __construct(GoblinItem $item, SellInProperty $sellIn, QualityProperty $quality = null)
    {
        parent::__construct($item, $sellIn, new LegendaryQualityProperty());
    }

    public function dayPasses(): void
    {
        // Sulfuras shouldn't use the dayPasses function since it doesn't do anything
    }
}