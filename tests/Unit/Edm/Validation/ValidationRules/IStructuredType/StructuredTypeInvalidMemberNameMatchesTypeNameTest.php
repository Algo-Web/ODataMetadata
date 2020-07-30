<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30/07/20
 * Time: 2:15 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IStructuredType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType\StructuredTypeInvalidMemberNameMatchesTypeName;
use Mockery as m;

class StructuredTypeInvalidMemberNameMatchesTypeNameTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvokePropertiesActuallyEmpty()
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $dependentProperties = [];

        $element = m::mock(INavigationProperty::class . ', ' . IStructuredType::class . ', ' . ISchemaType::class);
        $element->shouldReceive('getDependentProperties')->andReturn($dependentProperties);
        $element->shouldReceive('properties')->andReturn($dependentProperties);
        $element->shouldReceive('getName')->andReturn('element');

        $foo = new StructuredTypeInvalidMemberNameMatchesTypeName();

        $foo->__invoke($context, $element);

        $this->assertEquals(0, count($context->getErrors()));
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokePropertiesFilteredEmpty()
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $dependentProperties = [null];

        $element = m::mock(INavigationProperty::class . ', ' . IStructuredType::class . ', ' . ISchemaType::class);
        $element->shouldReceive('getDependentProperties')->andReturn($dependentProperties);
        $element->shouldReceive('properties')->andReturn($dependentProperties);
        $element->shouldReceive('getName')->andReturn('element');

        $foo = new StructuredTypeInvalidMemberNameMatchesTypeName();

        $foo->__invoke($context, $element);

        $this->assertEquals(0, count($context->getErrors()));
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokePropertiesNameMismatchEmpty()
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $prop = m::mock(IProperty::class);
        $prop->shouldReceive('getName')->andReturn('prop');

        $dependentProperties = [$prop];

        $element = m::mock(INavigationProperty::class . ', ' . IStructuredType::class . ', ' . ISchemaType::class);
        $element->shouldReceive('getDependentProperties')->andReturn($dependentProperties);
        $element->shouldReceive('properties')->andReturn($dependentProperties);
        $element->shouldReceive('getName')->andReturn('element');

        $foo = new StructuredTypeInvalidMemberNameMatchesTypeName();

        $foo->__invoke($context, $element);

        $this->assertEquals(0, count($context->getErrors()));
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokePropertiesNameMatchNotEmpty()
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $propLoc = m::mock(ILocation::class);

        $prop = m::mock(IProperty::class);
        $prop->shouldReceive('getName')->andReturn('element');
        $prop->shouldReceive('location')->andReturn($propLoc);

        $dependentProperties = [$prop];

        $loc = m::mock(ILocation::class);

        $element = m::mock(IStructuredType::class . ', ' . ISchemaType::class);
        $element->shouldReceive('getDependentProperties')->andReturn($dependentProperties);
        $element->shouldReceive('properties')->andReturn($dependentProperties);
        $element->shouldReceive('getName')->andReturn('element');
        $element->shouldReceive('location')->andReturn($loc);

        $foo = new StructuredTypeInvalidMemberNameMatchesTypeName();

        $foo->__invoke($context, $element);

        $this->assertEquals(1, count($context->getErrors()));
        $error = $context->getErrors()[0];

        $errorCode = EdmErrorCode::BadProperty();
        $this->assertEquals($errorCode, $error->getErrorCode());

        $expected = 'The member name \'element\' cannot be used in a type with the same name. Member names cannot be'.
                    ' the same as their enclosing type.';
        $this->assertEquals($expected, $error->getErrorMessage());
    }
}
