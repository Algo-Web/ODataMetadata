<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Library\Internal\Ambiguous;

use AlgoWeb\ODataMetadata\Exception\ArgumentNullException;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Library\Internal\Ambiguous\AmbiguousFunctionBinding;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class AmbiguousFunctionBindingTest extends TestCase
{
    public function testGetDefiningExpression()
    {
        $func1 = m::mock(IFunction::class);
        $func1->shouldReceive('getName')->andReturn('func1');
        $func2 = m::mock(IFunction::class);
        //$func2->shouldReceive('getName')->andReturn('func2');

        $foo = new AmbiguousFunctionBinding($func1, $func2);

        $expected = null;
        $actual   = $foo->getDefiningExpression();
        $this->assertEquals($expected, $actual);
    }

    public function testGetReturnType()
    {
        $func1 = m::mock(IFunction::class);
        $func1->shouldReceive('getName')->andReturn('func1');
        $func2 = m::mock(IFunction::class);
        //$func2->shouldReceive('getName')->andReturn('func2');

        $foo = new AmbiguousFunctionBinding($func1, $func2);

        $expected = null;
        $actual   = $foo->getReturnType();
        $this->assertEquals($expected, $actual);
    }

    public function testGetNamespace()
    {
        $func1 = m::mock(IFunction::class);
        $func1->shouldReceive('getName')->andReturn('func1');
        $func1->shouldReceive('getNamespace')->andReturn('LARGEHAM');
        $func2 = m::mock(IFunction::class);
        //$func2->shouldReceive('getName')->andReturn('func2');

        $foo = new AmbiguousFunctionBinding($func1, $func2);

        $expected = 'LARGEHAM';
        $actual   = $foo->getNamespace();
        $this->assertEquals($expected, $actual);
    }

    public function testGetNamespaceNull()
    {
        $func1 = m::mock(IFunction::class);
        $func1->shouldReceive('getName')->andReturn('func1');
        $func1->shouldReceive('getNamespace')->andReturn(null);
        $func2 = m::mock(IFunction::class);
        //$func2->shouldReceive('getName')->andReturn('func2');

        $foo = new AmbiguousFunctionBinding($func1, $func2);

        $this->expectException(ArgumentNullException::class);
        $this->expectExceptionMessage('Value for parameter bindings[0]->getNamespace cannot be null.');

        $foo->getNamespace();
    }

    public function testGetParameters()
    {
        $func1 = m::mock(IFunction::class);
        $func1->shouldReceive('getName')->andReturn('func1');
        $func1->shouldReceive('getParameters')->andReturn([]);
        $func2 = m::mock(IFunction::class);
        //$func2->shouldReceive('getName')->andReturn('func2');

        $foo = new AmbiguousFunctionBinding($func1, $func2);

        $expected = [];
        $actual   = $foo->getParameters();
        $this->assertEquals($expected, $actual);
    }

    public function testFindParameter()
    {
        $func1 = m::mock(IFunction::class);
        $func1->shouldReceive('getName')->andReturn('func1');
        $func1->shouldReceive('findParameter')->andReturn(null);
        $func2 = m::mock(IFunction::class);
        //$func2->shouldReceive('getName')->andReturn('func2');

        $foo = new AmbiguousFunctionBinding($func1, $func2);

        $expected = null;
        $actual   = $foo->findParameter('foo');
        $this->assertEquals($expected, $actual);
    }
}
