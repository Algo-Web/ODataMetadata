<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30/07/20
 * Time: 4:24 PM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyInvalidToPropertyInRelationshipConstraintBeforeV2;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class NavigationPropertyInvalidToPropertyInRelationshipConstraintBeforeV2Test extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvokeNullDependentProperties()
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('getDependentProperties')->andReturn(null);

        $foo = new NavigationPropertyInvalidToPropertyInRelationshipConstraintBeforeV2();

        $foo->__invoke($context, $element);

        $this->assertEquals(0, count($context->getErrors()));
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokeIsNotSubset()
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $keyProp = m::mock(IStructuralProperty::class . ', ' . INavigationProperty::class);

        $eType = m::mock(IEntityType::class);
        $eType->shouldReceive('key')->andReturn([$keyProp]);
        $eType->shouldReceive('fullName')->andReturn('entity');

        $prop = m::mock(IStructuralProperty::class);

        $loc = m::mock(ILocation::class);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('getDependentProperties')->andReturn([$prop]);
        $element->shouldReceive('declaringEntityType')->andReturn($eType);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('getName')->andReturn('navprop');

        $foo = new NavigationPropertyInvalidToPropertyInRelationshipConstraintBeforeV2();

        $foo->__invoke($context, $element);

        $this->assertEquals(1, count($context->getErrors()));
        $error     = $context->getErrors()[0];
        $errorCode = EdmErrorCode::InvalidPropertyInRelationshipConstraint();
        $this->assertEquals($errorCode, $error->getErrorCode());
        $expected = 'The properties referred by the dependent role \'navprop\' must be a subset of the key of the'
                    . ' entity type \'entity\'.';
        $this->assertEquals($expected, $error->getErrorMessage());
    }
}
