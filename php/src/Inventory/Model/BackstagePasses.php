<?php

declare(strict_types=1);

namespace GildedRose\Inventory\Model;

class BackstagePasses extends AbstractInventoryModel
{
    public const NAME = 'Backstage passes to a TAFKAL80ETC concert';

    public function dayPasses(): void
    {
        // TODO: Implement logic that sets the following:
        //  - Quality increases by 1 if sellIn date is more than 10
        //  - Quality increases by 2 if sellIn date is less than or equal to 10
        //  - Quality increases by 3 if sellIn date is less than or equal to 5
        //  - Quality drops to zero after or on SellIn date
    }
}