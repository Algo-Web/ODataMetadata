<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26/07/20
 * Time: 11:56 AM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPathExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Library\EdmFunctionImport;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class FunctionImportHelpersTest extends TestCase
{
    public function tryGetStaticEntitySetProvider(): array
    {
        $result   = [];
        $result[] = [null, false];
        $result[] = [m::mock(IExpression::class . ', ' . IFunctionImport::class), false];
        $result[] = [m::mock(IExpression::class . ', ' . IFunctionImport::class . ', ' . IEntitySet::class), true];

        return $result;
    }

    /**
     * @dataProvider tryGetStaticEntitySetProvider
     *
     * @param $entityResult
     * @param bool $expected
     */
    public function testTryGetStaticEntitySet($entityResult, bool $expected)
    {
        $foo = m::mock(EdmFunctionImport::class)->makePartial();
        $foo->shouldReceive('getEntitySet')->andReturn($entityResult);

        $raw = null;

        $actual = $foo->tryGetStaticEntitySet($raw);
        $this->assertEquals($expected, $actual);

        if ($expected) {
            $this->assertTrue($raw instanceof IEntitySet);
        } else {
            $this->assertNull($raw);
        }
    }

    public function testTryGetRelativeEntitySetPathBadEntitySet()
    {
        $foo = m::mock(EdmFunctionImport::class)->makePartial();
        $foo->shouldReceive('getEntitySet')->andReturn(null);

        $model = m::mock(IModel::class);
        $parm  = null;
        $path  = null;

        $expected = false;

        $actual = $foo->tryGetRelativeEntitySetPath($model, $parm, $path);
        $this->assertEquals($expected, $actual);
        $this->assertNull($parm);
        $this->assertNull($path);
    }

    public function testTryGetRelativeEntitySetPathGoodEntitySetEmptyPath()
    {
        $eSet = m::mock(IPathExpression::class);
        $eSet->shouldReceive('getPath')->andReturn([])->once();

        $foo = m::mock(EdmFunctionImport::class)->makePartial();
        $foo->shouldReceive('getEntitySet')->andReturn($eSet);

        $model = m::mock(IModel::class);
        $parm  = null;
        $path  = null;

        $expected = false;

        $actual = $foo->tryGetRelativeEntitySetPath($model, $parm, $path);
        $this->assertEquals($expected, $actual);
        $this->assertNull($parm);
        $this->assertNull($path);
    }

    public function testTryGetRelativeEntitySetPathGoodEntitySetOnNonEmptyPathNoParm()
    {
        $eSet = m::mock(IPathExpression::class);
        $eSet->shouldReceive('getPath')->andReturn(['foo'])->once();

        $foo = m::mock(EdmFunctionImport::class)->makePartial();
        $foo->shouldReceive('getEntitySet')->andReturn($eSet);
        $foo->shouldReceive('findParameter')->withArgs(['foo'])->andReturn(null)->once();

        $model = m::mock(IModel::class);
        $parm  = null;
        $path  = null;

        $expected = false;

        $actual = $foo->tryGetRelativeEntitySetPath($model, $parm, $path);
        $this->assertEquals($expected, $actual);
        $this->assertNull($parm);
        $this->assertNull($path);
    }

    public function testTryGetRelativeEntitySetPathGoodEntitySetOnNonEmptyPathHasParm()
    {
        $eSet = m::mock(IPathExpression::class);
        $eSet->shouldReceive('getPath')->andReturn(['foo'])->once();

        $parm = m::mock(IFunctionParameter::class);

        $foo = m::mock(EdmFunctionImport::class)->makePartial();
        $foo->shouldReceive('getEntitySet')->andReturn($eSet);
        $foo->shouldReceive('findParameter')->withArgs(['foo'])->andReturn($parm)->once();

        $model = m::mock(IModel::class);
        $parm  = null;
        $path  = null;

        $expected = true;

        $actual = $foo->tryGetRelativeEntitySetPath($model, $parm, $path);
        $this->assertEquals($expected, $actual);
        $this->assertNotNull($parm);
        $this->assertTrue($parm instanceof IFunctionParameter);
        $this->assertEquals([], $path);
    }

    public function testTryGetRelativeEntitySetPathGoodEntitySetOnTwoPath()
    {
        $eSet = m::mock(IPathExpression::class);
        $eSet->shouldReceive('getPath')->andReturn(['foo', 'bar'])->once();

        $eType = m::mock(IEntityType::class);
        $eType->shouldReceive('findProperty')->andReturn(null)->once();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('isCollection')->andReturn(false)->once();
        $typeRef->shouldReceive('asEntity->entityDefinition')->andReturn($eType);

        $parm = m::mock(IFunctionParameter::class);
        $parm->shouldReceive('getType')->andReturn($typeRef);

        $foo = m::mock(EdmFunctionImport::class)->makePartial();
        $foo->shouldReceive('getEntitySet')->andReturn($eSet);
        $foo->shouldReceive('findParameter')->withArgs(['foo'])->andReturn($parm)->once();

        $model = m::mock(IModel::class);
        $parm  = null;
        $path  = null;

        $expected = false;

        $actual = $foo->tryGetRelativeEntitySetPath($model, $parm, $path);
        $this->assertEquals($expected, $actual);
        $this->assertNotNull($parm);
        $this->assertTrue($parm instanceof IFunctionParameter);
        $this->assertEquals(null, $path);
    }

    public function testTryGetRelativeEntitySetPathGoodEntitySetOnTwoPathGoodNavProperty()
    {
        $eSet = m::mock(IPathExpression::class);
        $eSet->shouldReceive('getPath')->andReturn(['foo', 'bar'])->once();

        $nType = m::mock(IEntityType::class);

        $navType = m::mock(ITypeReference::class);
        $navType->shouldReceive('isCollection')->andReturn(false)->once();
        $navType->shouldReceive('asEntity->entityDefinition')->andReturn($nType);

        $navProp = m::mock(INavigationProperty::class);
        $navProp->shouldReceive('getType')->andReturn($navType);

        $eType = m::mock(IEntityType::class);
        $eType->shouldReceive('findProperty')->andReturn($navProp)->once();

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('isCollection')->andReturn(false)->once();
        $typeRef->shouldReceive('asEntity->entityDefinition')->andReturn($eType);

        $parm = m::mock(IFunctionParameter::class);
        $parm->shouldReceive('getType')->andReturn($typeRef);

        $foo = m::mock(EdmFunctionImport::class)->makePartial();
        $foo->shouldReceive('getEntitySet')->andReturn($eSet);
        $foo->shouldReceive('findParameter')->withArgs(['foo'])->andReturn($parm)->once();

        $model = m::mock(IModel::class);
        $parm  = null;
        $path  = null;

        $expected = true;

        $actual = $foo->tryGetRelativeEntitySetPath($model, $parm, $path);
        $this->assertEquals($expected, $actual);
        $this->assertNotNull($parm);
        $this->assertTrue($parm instanceof IFunctionParameter);
        $this->assertEquals([$navProp], $path);
    }
}
