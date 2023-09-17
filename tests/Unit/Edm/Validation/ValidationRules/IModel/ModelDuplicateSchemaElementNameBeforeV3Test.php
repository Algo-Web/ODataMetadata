<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30/07/20
 * Time: 11:21 PM.
 */

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IModel;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IModel\ModelDuplicateSchemaElementNameBeforeV3;
use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class ModelDuplicateSchemaElementNameBeforeV3Test extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvokeSingleFunction()
    {
        $model   = m::mock(IModel::class);
        $context = new ValidationContext($model, function (IEdmElement $one): bool {
            return false;
        });

        $schema = m::mock(IFunction::class);
        $schema->shouldReceive('fullName')->andReturn('schema');
        $schema->shouldReceive('getSchemaElementKind')->andReturn(SchemaElementKind::None());

        $element = m::mock(IModel::class)->makePartial();
        $element->shouldReceive('getSchemaElements')->andReturn([$schema]);
        $element->shouldReceive('getReferencedModels')->andReturn([]);

        $foo = new ModelDuplicateSchemaElementNameBeforeV3();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokeDuplicatedFunction()
    {
        $model   = m::mock(IModel::class);
        $context = new ValidationContext($model, function (IEdmElement $one): bool {
            return false;
        });

        $loc = m::mock(ILocation::class);

        $schema = m::mock(IFunction::class);
        $schema->shouldReceive('fullName')->andReturn('schema');
        $schema->shouldReceive('getSchemaElementKind')->andReturn(SchemaElementKind::None());
        $schema->shouldReceive('location')->andReturn($loc);

        $element = m::mock(IModel::class)->makePartial();
        $element->shouldReceive('getSchemaElements')->andReturn([$schema, $schema]);
        $element->shouldReceive('getReferencedModels')->andReturn([]);

        $foo = new ModelDuplicateSchemaElementNameBeforeV3();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokeSingleNonFunction()
    {
        $model   = m::mock(IModel::class);
        $context = new ValidationContext($model, function (IEdmElement $one): bool {
            return false;
        });

        $schema = m::mock(ISchemaElement::class);
        $schema->shouldReceive('fullName')->andReturn('schema');
        $schema->shouldReceive('getSchemaElementKind')->andReturn(SchemaElementKind::None());

        $element = m::mock(IModel::class)->makePartial();
        $element->shouldReceive('getSchemaElements')->andReturn([$schema]);
        $element->shouldReceive('getReferencedModels')->andReturn([]);

        $foo = new ModelDuplicateSchemaElementNameBeforeV3();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokeDuplicateNonFunction()
    {
        $model   = m::mock(IModel::class);
        $context = new ValidationContext($model, function (IEdmElement $one): bool {
            return false;
        });

        $loc = m::mock(ILocation::class);

        $schema = m::mock(ISchemaElement::class);
        $schema->shouldReceive('fullName')->andReturn('schema');
        $schema->shouldReceive('location')->andReturn($loc);
        $schema->shouldReceive('getSchemaElementKind')->andReturn(SchemaElementKind::None());

        $element = m::mock(IModel::class)->makePartial();
        $element->shouldReceive('getSchemaElements')->andReturn([$schema, $schema]);
        $element->shouldReceive('getReferencedModels')->andReturn([]);

        $foo = new ModelDuplicateSchemaElementNameBeforeV3();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokeNonFunctionThenDuplicateFunction()
    {
        $model   = m::mock(IModel::class);
        $context = new ValidationContext($model, function (IEdmElement $one): bool {
            return false;
        });

        $loc = m::mock(ILocation::class);

        $schema = m::mock(ISchemaElement::class);
        $schema->shouldReceive('fullName')->andReturn('schema');
        $schema->shouldReceive('location')->andReturn($loc);
        $schema->shouldReceive('getSchemaElementKind')->andReturn(SchemaElementKind::None());

        $func = m::mock(IFunction::class);
        $func->shouldReceive('fullName')->andReturn('schema');
        $func->shouldReceive('location')->andReturn($loc);
        $func->shouldReceive('getSchemaElementKind')->andReturn(SchemaElementKind::None());

        $element = m::mock(IModel::class)->makePartial();
        $element->shouldReceive('getSchemaElements')->andReturn([$schema, $func]);
        $element->shouldReceive('getReferencedModels')->andReturn([]);

        $foo = new ModelDuplicateSchemaElementNameBeforeV3();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
    }
}
