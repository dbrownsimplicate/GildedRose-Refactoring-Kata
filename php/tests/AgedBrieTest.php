<?php

namespace Tests;

use GildedRose\Inventory\Model\AgedBrie;
use GildedRose\Inventory\Property\Quality as QualityProperty;
use GildedRose\Inventory\Property\SellIn as SellInProperty;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class AgedBrieTest extends TestCase
{
    public function testUpdateItemAfterDayPasses()
    {
        $item = new Item(AgedBrie::NAME, 10, 10);
        $agedBrie = new AgedBrie($item, new SellInProperty(10), new QualityProperty(10));

        $agedBrie->dayPasses();

        $this->assertEquals(new Item(AgedBrie::NAME, 9, 11), $item);
    }

    public function testIncreaseQualityByOneWhenDayPasses()
    {
        $item = new Item(AgedBrie::NAME, 10, 10);
        $agedBrie = new AgedBrie($item, new SellInProperty(10), new QualityProperty(10));

        $agedBrie->dayPasses();

        $this->assertEquals(11, $item->quality);
    }

    public function testIncreaseQualityByTwoWhenDayPassesAndSellInHasPassed(): void
    {
        $item = new Item(AgedBrie::NAME, 0, 10);
        $agedBrie = new AgedBrie($item, new SellInProperty(0), new QualityProperty(10));

        $agedBrie->dayPasses();

        $this->assertEquals(12, $item->quality);
    }

    public function testUpdateItemsQualityWhenCreatingAgedBrie(): void
    {
        $item = new Item(AgedBrie::NAME, 10, -1);

        new AgedBrie($item, new SellInProperty(10), new QualityProperty(-1));

        $this->assertEquals(0, $item->quality);
    }
}
