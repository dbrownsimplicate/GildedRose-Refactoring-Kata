<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Inventory\Builder\InventoryBuilder;

final class GildedRose
{
    private array $items;

    private InventoryBuilder $inventoryBuilder;

    public function __construct(InventoryBuilder $inventoryBuilder, $items)
    {
        $this->inventoryBuilder = $inventoryBuilder;
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $this->inventoryBuilder->build($item)->dayPasses();
        }
    }
}
