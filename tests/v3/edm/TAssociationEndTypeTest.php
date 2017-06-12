<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationEndType;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class TAssociationEndTypeTest extends TestCase
{
    public function testBadMultiplicity()
    {
        $expected = "Multiplicity must be a valid TMultiplicity";
        $actual = null;

        $foo = new TAssociationEndType();
        $mult = 'abc';

        try {
            $foo->setMultiplicity($mult);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }
}