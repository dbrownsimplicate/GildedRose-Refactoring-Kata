<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testAgedBrieBeforeSellInDate(): void
    {
        $items = [new Item('Aged Brie', 10, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(9, $items[0]->sell_in);
        $this->assertEquals(11, $items[0]->quality);
    }

    public function testAgedBrieOnSellInDate(): void
    {
        $items = [new Item('Aged Brie', 0, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(-1, $items[0]->sell_in);
        $this->assertEquals(12, $items[0]->quality);
    }

    public function testAgedBrieAfterSellInDate(): void
    {
        $items = [new Item('Aged Brie', -5, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(-6, $items[0]->sell_in);
        $this->assertEquals(12, $items[0]->quality);
    }

    public function testAgedBrieBeforeSellInDateWithMaximumQuality(): void
    {
        $items = [new Item('Aged Brie', 10, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(9, $items[0]->sell_in);
        $this->assertEquals(50, $items[0]->quality);
    }

    public function testAgedBrieOnSellInDateWithMaximumQuality(): void
    {
        $items = [new Item('Aged Brie', 0, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(-1, $items[0]->sell_in);
        $this->assertEquals(50, $items[0]->quality);
    }

    public function testAgedBrieOnSellInDateNearMaximumQuality(): void
    {
        $items = [new Item('Aged Brie', 0, 49)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(-1, $items[0]->sell_in);
        $this->assertEquals(50, $items[0]->quality);
    }

    public function testAgedBrieAfterSellInDateWithMaximumQuality(): void
    {
        $items = [new Item('Aged Brie', -10, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(-11, $items[0]->sell_in);
        $this->assertEquals(50, $items[0]->quality);
    }

    public function testBackstagePassesBeforeSellInDate(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(9, $items[0]->sell_in);
        $this->assertEquals(12, $items[0]->quality);
    }

    public function testBackstagePassesMoreThanTenDaysBeforeSellInDate(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 11, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(10, $items[0]->sell_in);
        $this->assertEquals(11, $items[0]->quality);
    }

    public function testBackstagePassesQualityIncreaseByThreeWithFiveDaysLeftToSellInDate(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(4, $items[0]->sell_in);
        $this->assertEquals(13, $items[0]->quality);
    }


    public function testBackstagePassesQualityDropsToZeroAfterSellInDate(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(-1, $items[0]->sell_in);
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testBackstagePassesCloseToSellInDateWithMaximumQuality(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(9, $items[0]->sell_in);
        $this->assertEquals(50, $items[0]->quality);
    }

    public function testBackstagePassesFiveDaysLeftToSellInDateWithMaximumQuality(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(4, $items[0]->sell_in);
        $this->assertEquals(50, $items[0]->quality);
    }

    public function testBackstagePassesQualityDropsToZeroAfterSellInDateWithMaximumQuality(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(-1, $items[0]->sell_in);
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testSulfurasBeforeSellInDate()
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 10, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(10, $items[0]->sell_in);
        $this->assertEquals(10, $items[0]->quality);
    }

    public function testSulfurasOnSellInDate()
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 0, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(0, $items[0]->sell_in);
        $this->assertEquals(10, $items[0]->quality);
    }

    public function testSulfurasAfterSellInDate()
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', -1, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(-1, $items[0]->sell_in);
        $this->assertEquals(10, $items[0]->quality);
    }

    public function testElixirBeforeSellInDate()
    {
        $items = [new Item('Elixir of the Mongoose', 10, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(9, $items[0]->sell_in);
        $this->assertEquals(9, $items[0]->quality);
    }

    public function testElixirOnSellInDate()
    {
        $items = [new Item('Elixir of the Mongoose', 0, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(-1, $items[0]->sell_in);
        $this->assertEquals(8, $items[0]->quality);
    }

    public function testElixirAfterSellInDate()
    {
        $items = [new Item('Elixir of the Mongoose', -5, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(-6, $items[0]->sell_in);
        $this->assertEquals(8, $items[0]->quality);
    }

    public function testDexterityVestBeforeSellInDate()
    {
        $items = [new Item('+5 Dexterity Vest', 10, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(9, $items[0]->sell_in);
        $this->assertEquals(9, $items[0]->quality);
    }

    public function testDexterityVestOnSellInDate()
    {
        $items = [new Item('+5 Dexterity Vest', 0, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(-1, $items[0]->sell_in);
        $this->assertEquals(8, $items[0]->quality);
    }

    public function testDexterityVestAfterSellInDate()
    {
        $items = [new Item('+5 Dexterity Vest', -5, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertEquals(-6, $items[0]->sell_in);
        $this->assertEquals(8, $items[0]->quality);
    }

}
