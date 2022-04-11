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
}
