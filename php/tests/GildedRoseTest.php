<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Inventory\Builder\InventoryBuilder;
use GildedRose\Inventory\Model\AgedBrie;
use GildedRose\Inventory\Model\BackstagePasses;
use GildedRose\Inventory\Model\ConjuredManaCake;
use GildedRose\Inventory\Model\DexterityVest;
use GildedRose\Inventory\Model\Elixir;
use GildedRose\Inventory\Model\Sulfuras;
use GildedRose\Item;
use PHPUnit\Framework\Constraint\IsEqual;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testAgedBrieBeforeSellInDate(): void
    {
        $items = [new Item(AgedBrie::NAME, 10, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(9, $items[0]->sell_in);
        $this->assertEqualsQuality(11, $items[0]->quality);
    }

    public function testAgedBrieOnSellInDate(): void
    {
        $items = [new Item(AgedBrie::NAME, 0, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(-1, $items[0]->sell_in);
        $this->assertEqualsQuality(12, $items[0]->quality);
    }

    public function testAgedBrieAfterSellInDate(): void
    {
        $items = [new Item(AgedBrie::NAME, -5, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(-6, $items[0]->sell_in);
        $this->assertEqualsQuality(12, $items[0]->quality);
    }

    public function testAgedBrieBeforeSellInDateWithMaximumQuality(): void
    {
        $items = [new Item(AgedBrie::NAME, 10, 50)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(9, $items[0]->sell_in);
        $this->assertEqualsQuality(50, $items[0]->quality);
    }

    public function testAgedBrieOnSellInDateWithMaximumQuality(): void
    {
        $items = [new Item(AgedBrie::NAME, 0, 50)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(-1, $items[0]->sell_in);
        $this->assertEqualsQuality(50, $items[0]->quality);
    }

    public function testAgedBrieOnSellInDateNearMaximumQuality(): void
    {
        $items = [new Item(AgedBrie::NAME, 0, 49)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(-1, $items[0]->sell_in);
        $this->assertEqualsQuality(50, $items[0]->quality);
    }

    public function testAgedBrieAfterSellInDateWithMaximumQuality(): void
    {
        $items = [new Item(AgedBrie::NAME, -10, 50)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(-11, $items[0]->sell_in);
        $this->assertEqualsQuality(50, $items[0]->quality);
    }

    public function testBackstagePassesBeforeSellInDate(): void
    {
        $items = [new Item(BackstagePasses::NAME, 10, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(9, $items[0]->sell_in);
        $this->assertEqualsQuality(12, $items[0]->quality);
    }

    public function testBackstagePassesMoreThanTenDaysBeforeSellInDate(): void
    {
        $items = [new Item(BackstagePasses::NAME, 11, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(10, $items[0]->sell_in);
        $this->assertEqualsQuality(12, $items[0]->quality);
    }

    public function testBackstagePassesQualityIncreaseByThreeWithFiveDaysLeftToSellInDate(): void
    {
        $items = [new Item(BackstagePasses::NAME, 5, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(4, $items[0]->sell_in);
        $this->assertEqualsQuality(13, $items[0]->quality);
    }


    public function testBackstagePassesQualityDropsToZeroAfterSellInDate(): void
    {
        $items = [new Item(BackstagePasses::NAME, 0, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(-1, $items[0]->sell_in);
        $this->assertEqualsQuality(0, $items[0]->quality);
    }

    public function testBackstagePassesCloseToSellInDateWithMaximumQuality(): void
    {
        $items = [new Item(BackstagePasses::NAME, 10, 50)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(9, $items[0]->sell_in);
        $this->assertEqualsQuality(50, $items[0]->quality);
    }

    public function testBackstagePassesFiveDaysLeftToSellInDateWithMaximumQuality(): void
    {
        $items = [new Item(BackstagePasses::NAME, 5, 50)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(4, $items[0]->sell_in);
        $this->assertEqualsQuality(50, $items[0]->quality);
    }

    public function testBackstagePassesQualityDropsToZeroAfterSellInDateWithMaximumQuality(): void
    {
        $items = [new Item(BackstagePasses::NAME, 0, 50)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(-1, $items[0]->sell_in);
        $this->assertEqualsQuality(0, $items[0]->quality);
    }

    public function testSulfurasBeforeSellInDate()
    {
        $items = [new Item(Sulfuras::NAME, 10, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(10, $items[0]->sell_in);
        $this->assertEqualsQuality(80, $items[0]->quality);
    }

    public function testSulfurasOnSellInDate()
    {
        $items = [new Item(Sulfuras::NAME, 0, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(0, $items[0]->sell_in);
        $this->assertEqualsQuality(80, $items[0]->quality);
    }

    public function testSulfurasAfterSellInDate()
    {
        $items = [new Item(Sulfuras::NAME, -1, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(-1, $items[0]->sell_in);
        $this->assertEqualsQuality(80, $items[0]->quality);
    }

    public function testElixirBeforeSellInDate()
    {
        $items = [new Item(Elixir::NAME, 10, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(9, $items[0]->sell_in);
        $this->assertEqualsQuality(9, $items[0]->quality);
    }

    public function testElixirOnSellInDate()
    {
        $items = [new Item(Elixir::NAME, 0, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(-1, $items[0]->sell_in);
        $this->assertEqualsQuality(8, $items[0]->quality);
    }

    public function testElixirAfterSellInDate()
    {
        $items = [new Item(Elixir::NAME, -5, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(-6, $items[0]->sell_in);
        $this->assertEqualsQuality(8, $items[0]->quality);
    }

    public function testDexterityVestBeforeSellInDate()
    {
        $items = [new Item(DexterityVest::NAME, 10, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(9, $items[0]->sell_in);
        $this->assertEqualsQuality(9, $items[0]->quality);
    }

    public function testDexterityVestOnSellInDate()
    {
        $items = [new Item(DexterityVest::NAME, 0, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(-1, $items[0]->sell_in);
        $this->assertEqualsQuality(8, $items[0]->quality);
    }

    public function testDexterityVestAfterSellInDate()
    {
        $items = [new Item(DexterityVest::NAME, -5, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(-6, $items[0]->sell_in);
        $this->assertEqualsQuality(8, $items[0]->quality);
    }

    public function testConjuredManaCakeBeforeSellInDate()
    {
        $items = [new Item(ConjuredManaCake::NAME, 10, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(9, $items[0]->sell_in);
        $this->assertEqualsQuality(8, $items[0]->quality);
    }

    public function testConjuredManaCakeOnSellInDate()
    {
        $items = [new Item(ConjuredManaCake::NAME, 0, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(-1, $items[0]->sell_in);
        $this->assertEqualsQuality(6, $items[0]->quality);
    }

    public function testConjuredManaCakeAfterSellInDate()
    {
        $items = [new Item(ConjuredManaCake::NAME, -5, 10)];
        $gildedRose = new GildedRose(new InventoryBuilder(), $items);

        $gildedRose->updateQuality();

        $this->assertEqualsSellInDays(-6, $items[0]->sell_in);
        $this->assertEqualsQuality(6, $items[0]->quality);
    }

    public static function assertEqualsQuality($expectedQuality, $actual, string $message = ''): void
    {
        $constraint = new IsEqual($expectedQuality);

        static::assertThat($actual, $constraint, $message);
    }

    public static function assertEqualsSellInDays($expectedSellInDays, $actual, string $message = ''): void
    {
        $constraint = new IsEqual($expectedSellInDays);

        static::assertThat($actual, $constraint, $message);
    }
}
