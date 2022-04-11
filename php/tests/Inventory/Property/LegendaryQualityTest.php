<?php

namespace Tests\Inventory\Property;

use GildedRose\Inventory\Property\LegendaryQuality as LegendaryQualityProperty;
use PHPUnit\Framework\TestCase;

class LegendaryQualityTest extends TestCase
{
    public function testQualitySetToEightyByDefault()
    {
        $legendaryQualityProperty = new LegendaryQualityProperty();

        $this->assertEquals(80, $legendaryQualityProperty->getQualityInteger());
    }
}
