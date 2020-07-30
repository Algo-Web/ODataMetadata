<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26/07/20
 * Time: 4:16 PM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Library\Internal\Ambiguous;

use AlgoWeb\ODataMetadata\Enums\ContainerElementKind;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Library\Internal\Ambiguous\AmbiguousFunctionImportBinding;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class AmbiguousFunctionImportBindingTest extends TestCase
{
    public function testGetContainerElementKind()
    {
        $imp1 = m::mock(IFunctionImport::class);
        $imp1->shouldReceive('getName')->andReturn('name1');
        $imp2 = m::mock(IFunctionImport::class);
        //$imp2->shouldReceive('getName')->andReturn('name2');

        $foo = new AmbiguousFunctionImportBinding($imp1, $imp2);

        $expected = ContainerElementKind::FunctionImport();
        $actual   = $foo->getContainerElementKind();

        $this->assertEquals($expected, $actual);
    }

    public function testGetContainer()
    {
        $imp1 = m::mock(IFunctionImport::class);
        $imp1->shouldReceive('getName')->andReturn('name1');
        $imp1->shouldReceive('getContainer')->andReturn(null);
        $imp2 = m::mock(IFunctionImport::class);
        //$imp2->shouldReceive('getName')->andReturn('name2');

        $foo = new AmbiguousFunctionImportBinding($imp1, $imp2);

        $expected = null;
        $actual   = $foo->getContainer();

        $this->assertEquals($expected, $actual);
    }

    public function testGetReturnType()
    {
        $imp1 = m::mock(IFunctionImport::class);
        $imp1->shouldReceive('getName')->andReturn('name1');
        $imp2 = m::mock(IFunctionImport::class);
        //$imp2->shouldReceive('getName')->andReturn('name2');

        $foo = new AmbiguousFunctionImportBinding($imp1, $imp2);

        $expected = null;
        $actual   = $foo->getReturnType();

        $this->assertEquals($expected, $actual);
    }

    public function testGetParameters()
    {
        $imp1 = m::mock(IFunctionImport::class);
        $imp1->shouldReceive('getName')->andReturn('name1');
        $imp1->shouldReceive('getParameters')->andReturn([])->once();
        $imp2 = m::mock(IFunctionImport::class);
        //$imp2->shouldReceive('getName')->andReturn('name2');

        $foo = new AmbiguousFunctionImportBinding($imp1, $imp2);

        $expected = [];
        $actual   = $foo->getParameters();

        $this->assertEquals($expected, $actual);
    }

    public function testFindParameterMatch()
    {
        $parm = m::mock(IFunctionParameter::class);

        $imp1 = m::mock(IFunctionImport::class);
        $imp1->shouldReceive('getName')->andReturn('name1');
        $imp1->shouldReceive('findParameter')->andReturn($parm)->once();
        $imp2 = m::mock(IFunctionImport::class);
        //$imp2->shouldReceive('getName')->andReturn('name2');

        $foo = new AmbiguousFunctionImportBinding($imp1, $imp2);

        $expected = $parm;
        $actual   = $foo->findParameter('parm');

        $this->assertEquals($expected, $actual);
    }

    public function testFindParameterNoMatch()
    {
        $imp1 = m::mock(IFunctionImport::class);
        $imp1->shouldReceive('getName')->andReturn('name1');
        $imp1->shouldReceive('findParameter')->andReturn(null)->once();
        $imp2 = m::mock(IFunctionImport::class);
        //$imp2->shouldReceive('getName')->andReturn('name2');

        $foo = new AmbiguousFunctionImportBinding($imp1, $imp2);

        $expected = null;
        $actual   = $foo->findParameter('parm');

        $this->assertEquals($expected, $actual);
    }

    public function testFlags()
    {
        $imp1 = m::mock(IFunctionImport::class);
        $imp1->shouldReceive('getName')->andReturn('name1');
        $imp1->shouldReceive('findParameter')->andReturn(null)->once();
        $imp2 = m::mock(IFunctionImport::class);
        //$imp2->shouldReceive('getName')->andReturn('name2');

        $foo = new AmbiguousFunctionImportBinding($imp1, $imp2);

        $this->assertTrue($foo->isSideEffecting());
        $this->assertFalse($foo->isComposable());
        $this->assertFalse($foo->isBindable());
        $this->assertNull($foo->getEntitySet());
    }
}
