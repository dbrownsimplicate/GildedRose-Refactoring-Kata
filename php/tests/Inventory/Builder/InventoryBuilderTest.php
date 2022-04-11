<?php

namespace Tests\Inventory\Builder;

use GildedRose\Inventory\Builder\InventoryBuilder;
use GildedRose\Inventory\Model\AgedBrie;
use GildedRose\Inventory\Model\BackstagePasses;
use GildedRose\Inventory\Model\ConjuredManaCake;
use GildedRose\Inventory\Model\DexterityVest;
use GildedRose\Inventory\Model\ElixirOfTheMongoose;
use GildedRose\Inventory\Model\SulfurasHandOfRagnaros;
use GildedRose\Inventory\Property\Quality as QualityProperty;
use GildedRose\Inventory\Property\SellIn as SellInProperty;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class InventoryBuilderTest extends TestCase
{
    private InventoryBuilder $inventoryBuilder;

    protected function setUp(): void
    {
        $this->inventoryBuilder = new InventoryBuilder();
    }

    /**
     * @dataProvider inventoryDataProvider
     */
    public function testBuildCorrectClassWithGivenItemName(string $name, string $class): void
    {
        $item = new Item($name, 10, 10);

        $inventoryBuildResult = $this->inventoryBuilder->build($item);

        $this->assertEquals(new $class($item, new SellInProperty(10), new QualityProperty(10)), $inventoryBuildResult);
    }

    public function inventoryDataProvider(): array
    {
        return [
            [
                'name' => DexterityVest::NAME, 'class' => DexterityVest::class,
            ],
            [
                'name' => AgedBrie::NAME, 'class' => AgedBrie::class,
            ],
            [
                'name' => ElixirOfTheMongoose::NAME, 'class' => ElixirOfTheMongoose::class,
            ],
            [
                'name' => SulfurasHandOfRagnaros::NAME, 'class' => SulfurasHandOfRagnaros::class,
            ],
            [
                'name' => BackstagePasses::NAME, 'class' => BackstagePasses::class,
            ],
            [
                'name' => ConjuredManaCake::NAME, 'class' => ConjuredManaCake::class,
            ],
        ];
    }

    public function testBuildThrowExceptionWhenItemDoesNotExist(): void
    {
        $item = new Item('Goblin Chainmail', 10, 10);

        $this->expectException(RuntimeException::class);

        $this->inventoryBuilder->build($item);
    }
}
