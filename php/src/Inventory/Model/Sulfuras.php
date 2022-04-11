<?php

declare(strict_types=1);

namespace GildedRose\Inventory\Model;

class Sulfuras extends AbstractInventoryModel
{
    public const NAME = 'Sulfuras, Hand of Ragnaros';

    public function __construct()
    {
        // TODO: implement logic that uses a Legendary quality property that Sulfuras is supposed to have
        //  i.e. 80 quality and doesn't increase/decrease also no sellIn date
    }

    public function dayPasses(): void
    {
        // Sulfuras shouldn't use the dayPasses function since it doesn't do anything
    }
}