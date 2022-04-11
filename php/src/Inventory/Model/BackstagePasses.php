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
    }
}