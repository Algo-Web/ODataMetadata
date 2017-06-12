<?php

namespace AlgoWeb\ODataMetadata\Tests\v3\edm;

use AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationEndType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TOnActionType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

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

    public function testAddToOnDeleteBadData()
    {
        $expected = "";
        $actual = null;

        $foo = new TAssociationEndType();
        $onDelete = m::mock(TOnActionType::class)->makePartial();
        $onDelete->shouldReceive('isOK')->andReturn(false)->once();

        try {
            $foo->addToOnDelete($onDelete);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testAddToOnDeleteGoodData()
    {
        $foo = new TAssociationEndType();
        $onDelete = m::mock(TOnActionType::class)->makePartial();
        $onDelete->shouldReceive('isOK')->andReturn(true)->once();

        $foo->addToOnDelete($onDelete);
        $this->assertTrue($foo->issetOnDelete(0));
        $this->assertFalse($foo->issetOnDelete(1));

        $foo->unsetOnDelete(0);
        $this->assertFalse($foo->issetOnDelete(0));
        $this->assertFalse($foo->issetOnDelete(1));
    }

    public function testSetOnDeleteBadItem()
    {
        $expected = "";
        $actual = null;

        $foo = new TAssociationEndType();
        $onDelete = m::mock(TOnActionType::class)->makePartial();
        $onDelete->shouldReceive('isOK')->andReturn(false)->once();
        $delete = [$onDelete];

        try {
            $foo->setOnDelete($delete);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testIsTOperationsOKBadData()
    {
        $expected = "";
        $actual = null;

        $foo = new TAssociationEndType();
        $onDelete = m::mock(TOnActionType::class)->makePartial();
        $onDelete->shouldReceive('isOK')->andReturn(true, false)->twice();
        $delete = [$onDelete];

        $foo->setOnDelete($delete);

        $this->assertFalse($foo->isTOperationsOK($actual));
        $this->assertEquals($expected, $actual);
    }
}
