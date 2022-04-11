<?php

namespace Tests\Inventory\Property;

use GildedRose\Inventory\Property\Quality as QualityProperty;
use PHPUnit\Framework\TestCase;

class QualityTest extends TestCase
{
    public function testSetQualityToZeroWhenQualityIsNegative()
    {
        $qualityProperty = new QualityProperty(-1);

        $this->assertEquals(0, $qualityProperty->getQualityInteger());
    }

    public function testSetQualityToFiftyWhenItIsMoreThanFifty()
    {
        $qualityProperty = new QualityProperty(60);

        $this->assertEquals(50, $qualityProperty->getQualityInteger());
    }
}
