<?php

declare(strict_types=1);

namespace GildedRose\Inventory\Property;

class Quality
{
    protected int $quality;

    private const ONE = 1;
    private const ZERO = 0;
    private const MAXIMUM_QUALITY = 50;

    public function __construct(int $quality)
    {
        $this->setQuality($quality);
    }

    private function setQuality(int $quality): void
    {
        if ($quality < self::ONE) {
            $quality = self::ZERO;
        }

        if ($quality > self::MAXIMUM_QUALITY) {
            $quality = self::MAXIMUM_QUALITY;
        }

        $this->quality = $quality;
    }

    public function increase(int $byPoints): void
    {
        $this->setQuality($this->quality + $byPoints);
    }

    public function decrease(int $byPoints): void
    {
        $this->setQuality($this->quality - $byPoints);
    }

    public function setToZero(): void
    {
        $this->setQuality(self::ZERO);
    }

    public function getQualityInteger(): int
    {
        return $this->quality;
    }

}