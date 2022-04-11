<?php

namespace GildedRose\Inventory\Model;

use GildedRose\Inventory\Property\Quality as QualityProperty;
use GildedRose\Inventory\Property\SellIn as SellInProperty;
use GildedRose\Item as GoblinItem;

abstract class AbstractInventoryModel
{
    protected SellInProperty $sellIn;
    protected QualityProperty $quality;
    protected GoblinItem $item;

    protected int $qualityDegradation = 1;

    public function __construct(GoblinItem $item, SellInProperty $sellIn, QualityProperty $quality)
    {
        $this->item = $item;
        $this->sellIn = $sellIn;
        $this->quality = $quality;

        $this->updateItem();
    }

    public static function build(GoblinItem $item): self
    {
        return new static($item, new SellInProperty($item->sell_in), new QualityProperty($item->quality));
    }

    protected function updateItem(): void
    {
        $this->item->sell_in = $this->sellIn->getDaysInteger();
        $this->item->quality = $this->quality->getQualityInteger();
    }

    public function dayPasses(): void
    {
        $this->sellIn->decrease();
        if ($this->sellIn->hasPassed()) {
            $this->qualityDegradation *= 2;
        }
        $this->quality->decrease($this->qualityDegradation);

        $this->updateItem();
    }
}