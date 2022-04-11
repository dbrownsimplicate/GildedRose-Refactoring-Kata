<?php

declare(strict_types=1);

namespace GildedRose\Inventory\Model;

class BackstagePasses extends AbstractInventoryModel
{
    public const NAME = 'Backstage passes to a TAFKAL80ETC concert';

    public function dayPasses(): void
    {
        $this->sellIn->decrease();

        switch ($this->sellIn) {
            case $this->sellIn->hasPassed():
                $this->quality->setToZero();
                break;
            case $this->sellIn->getDaysInteger() <= 5:
                $this->quality->increase(3);
                break;
            case $this->sellIn->getDaysInteger() <= 10:
                $this->quality->increase(2);
                break;
            default:
                $this->quality->increase(1);
        }

        $this->updateItem();

        // TODO: Implement logic that sets the following:
        //  + Quality increases by 1 if sellIn date is more than 10
        //  + Quality increases by 2 if sellIn date is less than or equal to 10
        //  + Quality increases by 3 if sellIn date is less than or equal to 5
        //  + Quality drops to zero after or on SellIn date
    }
}