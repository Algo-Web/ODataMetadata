<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27/07/20
 * Time: 2:40 AM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyDependentPropertiesMustBelongToDependentEntity;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class NavigationPropertyDependentPropertiesMustBelongToDependentEntityTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvokeNullDependentProperties()
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('getDependentProperties')->andReturn(null);

        $foo = new NavigationPropertyDependentPropertiesMustBelongToDependentEntity();

        $foo->__invoke($context, $element);

        $this->assertEquals(0, count($context->getErrors()));
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokeFiltersOutBadProperties()
    {
        $callable = function (IEdmElement $one): bool { return $one->getType()->getNullable(); };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $entityType = m::mock(IEntityType::class);
        $entityType->shouldReceive('findProperty')->andReturn(null);
        $entityType->shouldReceive('getName')->andReturn('eType');

        $prop1 = m::mock(IStructuralProperty::class);
        $prop1->shouldReceive('getType->getNullable')->andReturn(false);
        $prop1->shouldReceive('getName')->andReturn('prop1');
        $prop2 = m::mock(IStructuralProperty::class);
        $prop2->shouldReceive('getType->getNullable')->andReturn(true);
        $prop2->shouldReceive('getName')->andReturn('prop2');

        $this->assertFalse($context->checkIsBad($prop1));
        $this->assertTrue($context->checkIsBad($prop2));

        $dependentProperties = [$prop1, $prop2];

        $loc = m::mock(ILocation::class);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('getDependentProperties')->andReturn($dependentProperties);
        $element->shouldReceive('declaringEntityType')->andReturn($entityType);
        $element->shouldReceive('location')->andReturn($loc);

        $foo = new NavigationPropertyDependentPropertiesMustBelongToDependentEntity();

        $foo->__invoke($context, $element);

        $this->assertEquals(1, count($context->getErrors()));
        $error = $context->getErrors()[0];
        $errorCode = EdmErrorCode::DependentPropertiesMustBelongToDependentEntity();
        $this->assertEquals($errorCode, $error->getErrorCode());

        $expected = 'The dependent property \'prop1\' must belong to the dependent entity \'eType\'.';
        $actual = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }
}
