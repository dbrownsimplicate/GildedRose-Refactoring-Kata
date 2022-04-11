<?php

declare(strict_types=1);

namespace GildedRose\Inventory\Property;

class Quality
{
    protected int $quality;

    public function __construct(int $quality)
    {
        $this->setQuality($quality);
    }

    private function setQuality(int $quality): void
    {
        if($quality < 1) {
            $quality = 0;
        }
        if($quality > 50) {
            $quality = 50;
        }
        $this->quality = $quality;
    }
}