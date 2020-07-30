<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30/07/20
 * Time: 11:43 PM
 */

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IEntityContainer;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityContainer\EntityContainerDuplicateEntityContainerMemberName;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class EntityContainerDuplicateEntityContainerMemberNameTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvokeSingleFunctionImport()
    {
        $model   = m::mock(IModel::class);
        $context = new ValidationContext($model, function (IEdmElement $one): bool { return false; });

        $loc = m::mock(ILocation::class);

        $import = m::mock(IFunctionImport::class);
        $import->shouldReceive('location')->andReturn($loc);
        $import->shouldReceive('getName')->andReturn('name');

        $element = m::mock(IEntityContainer::class)->makePartial();
        $element->shouldReceive('getElements')->andReturn([$import]);

        $foo = new EntityContainerDuplicateEntityContainerMemberName();
        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokeDuplicatedFunctionImport()
    {
        $model   = m::mock(IModel::class);
        $context = new ValidationContext($model, function (IEdmElement $one): bool { return false; });

        $loc = m::mock(ILocation::class);

        $import = m::mock(IFunctionImport::class);
        $import->shouldReceive('location')->andReturn($loc);
        $import->shouldReceive('getName')->andReturn('name');

        $element = m::mock(IEntityContainer::class)->makePartial();
        $element->shouldReceive('getElements')->andReturn([$import, $import]);

        $foo = new EntityContainerDuplicateEntityContainerMemberName();
        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
    }

    public function testInvokeSingleNonFunctionImport()
    {
        $model   = m::mock(IModel::class);
        $context = new ValidationContext($model, function (IEdmElement $one): bool { return false; });

        $loc = m::mock(ILocation::class);

        $import = m::mock(IFunction::class);
        $import->shouldReceive('location')->andReturn($loc);
        $import->shouldReceive('getName')->andReturn('name');
        $import->shouldReceive('fullName')->andReturn('name');

        $element = m::mock(IEntityContainer::class)->makePartial();
        $element->shouldReceive('getElements')->andReturn([$import]);

        $foo = new EntityContainerDuplicateEntityContainerMemberName();
        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    public function testInvokeDuplicatedNonFunctionImport()
    {
        $model   = m::mock(IModel::class);
        $context = new ValidationContext($model, function (IEdmElement $one): bool { return false; });

        $loc = m::mock(ILocation::class);

        $import = m::mock(IFunction::class);
        $import->shouldReceive('location')->andReturn($loc);
        $import->shouldReceive('getName')->andReturn('name');
        $import->shouldReceive('fullName')->andReturn('name');

        $element = m::mock(IEntityContainer::class)->makePartial();
        $element->shouldReceive('getElements')->andReturn([$import, $import]);

        $foo = new EntityContainerDuplicateEntityContainerMemberName();
        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
    }

    public function testInvokeFunctionImportThenDuplicateNonFunctionImport()
    {
        $model   = m::mock(IModel::class);
        $context = new ValidationContext($model, function (IEdmElement $one): bool { return false; });

        $loc = m::mock(ILocation::class);

        $import = m::mock(IFunctionImport::class);
        $import->shouldReceive('location')->andReturn($loc);
        $import->shouldReceive('getName')->andReturn('name');

        $func = m::mock(IFunction::class);
        $func->shouldReceive('location')->andReturn($loc);
        $func->shouldReceive('getName')->andReturn('name');
        $func->shouldReceive('fullName')->andReturn('name');

        $element = m::mock(IEntityContainer::class)->makePartial();
        $element->shouldReceive('getElements')->andReturn([$import, $func]);

        $foo = new EntityContainerDuplicateEntityContainerMemberName();
        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
    }

    public function testInvokeNonFunctionImportThenDuplicateFunctionImport()
    {
        $model   = m::mock(IModel::class);
        $context = new ValidationContext($model, function (IEdmElement $one): bool { return false; });

        $loc = m::mock(ILocation::class);

        $import = m::mock(IFunctionImport::class);
        $import->shouldReceive('location')->andReturn($loc);
        $import->shouldReceive('getName')->andReturn('name');

        $func = m::mock(IFunction::class);
        $func->shouldReceive('location')->andReturn($loc);
        $func->shouldReceive('getName')->andReturn('name');
        $func->shouldReceive('fullName')->andReturn('name');

        $element = m::mock(IEntityContainer::class)->makePartial();
        $element->shouldReceive('getElements')->andReturn([$func, $import]);

        $foo = new EntityContainerDuplicateEntityContainerMemberName();
        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
    }
}
