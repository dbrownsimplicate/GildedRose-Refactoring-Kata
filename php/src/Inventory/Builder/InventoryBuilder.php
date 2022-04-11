<?php

namespace GildedRose\Inventory\Builder;

use GildedRose\Inventory\Model\AbstractInventoryModel;
use GildedRose\Inventory\Model\AgedBrie;
use GildedRose\Inventory\Model\BackstagePasses;
use GildedRose\Inventory\Model\ConjuredManaCake;
use GildedRose\Inventory\Model\DexterityVest;
use GildedRose\Inventory\Model\ElixirOfTheMongoose;
use GildedRose\Inventory\Model\Sulfuras;
use GildedRose\Item as GoblinItem;
use RuntimeException;

class InventoryBuilder
{
    public function build(GoblinItem $item): AbstractInventoryModel
    {
        switch ($item->name) {
            case AgedBrie::NAME:
                return AgedBrie::build($item);
            case BackstagePasses::NAME:
                return BackstagePasses::build($item);
            case ConjuredManaCake::NAME:
                return ConjuredManaCake::build($item);
            case DexterityVest::NAME:
                return DexterityVest::build($item);
            case ElixirOfTheMongoose::NAME:
                return ElixirOfTheMongoose::build($item);
            case Sulfuras::NAME:
                return Sulfuras::build($item);
            default:
                throw new RuntimeException(sprintf('Item [%s] does not exist', $item->name));
        }
    }
}