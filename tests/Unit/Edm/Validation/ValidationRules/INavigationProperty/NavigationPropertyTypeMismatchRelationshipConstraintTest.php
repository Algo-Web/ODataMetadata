<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30/07/20
 * Time: 2:01 AM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyTypeMismatchRelationshipConstraint;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Helpers\EdmElementComparer;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class NavigationPropertyTypeMismatchRelationshipConstraintTest extends TestCase
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

        $foo = new NavigationPropertyTypeMismatchRelationshipConstraint();

        $foo->__invoke($context, $element);

        $this->assertEquals(0, count($context->getErrors()));
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokeSingleDependentPropertiesMatchKey()
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $rType = m::mock(IType::class);

        $prop = m::mock(IStructuralProperty::class);
        $prop->shouldReceive('getType->getDefinition')->andReturn($rType);

        $eType = m::mock(IEntityType::class);
        $eType->shouldReceive('key')->andReturn([$prop]);

        $loc = m::mock(ILocation::class);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('getDependentProperties')->andReturn([$prop]);
        $element->shouldReceive('getPartner')->andReturn($element);
        $element->shouldReceive('declaringEntityType')->andReturn($eType);
        $element->shouldReceive('location')->andReturn($loc);

        $foo = new NavigationPropertyTypeMismatchRelationshipConstraint();

        $foo->__invoke($context, $element);

        $this->assertEquals(0, count($context->getErrors()));
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokeSingleDependentPropertiesMisMatchKey()
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $rType = m::mock(IType::class . ', ' . IEntityType::class);
        $rType->shouldReceive('getTypeKind')->andReturn(TypeKind::None());
        $rType->shouldReceive('isITypeEquivalentTo')->andReturn(false);

        $prop = m::mock(IStructuralProperty::class);
        $prop->shouldReceive('getType->getDefinition')->andReturn($rType);
        $prop->shouldReceive('getName')->andReturn('prop');

        $nuType = m::mock(IType::class);
        $nuType->shouldReceive('getTypeKind')->andReturn(TypeKind::Primitive());
        $nuType->shouldReceive('isITypeEquivalentTo')->andReturn(false);
        $nuProp = m::mock(IStructuralProperty::class);
        $nuProp->shouldReceive('getType->getDefinition')->andReturn($nuType);
        $nuProp->shouldReceive('getName')->andReturn('nuProp');

        $eType = m::mock(IEntityType::class);
        $eType->shouldReceive('key')->andReturn([$nuProp]);
        $eType->shouldReceive('fullName')->andReturn('fullName');
        $eType->shouldReceive('getName')->andReturn('fullName');

        $loc = m::mock(ILocation::class);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('getDependentProperties')->andReturn([$prop]);
        $element->shouldReceive('getPartner')->andReturn($element);
        $element->shouldReceive('declaringEntityType')->andReturn($eType);
        $element->shouldReceive('location')->andReturn($loc);

        $foo = new NavigationPropertyTypeMismatchRelationshipConstraint();

        $foo->__invoke($context, $element);

        $this->assertEquals(1, count($context->getErrors()));
        $error = $context->getErrors()[0];

        $errorCode = EdmErrorCode::TypeMismatchRelationshipConstraint();
        $this->assertEquals($errorCode, $error->getErrorCode());

        $expected = 'The types of all properties in the dependent role of a referential constraint must be the same'.
                    ' as the corresponding property types in the principal role. The type of property \'prop\' on'.
                    ' entity \'fullName\' does not match the type of property \'nuProp\' on entity \'fullName\' in'.
                    ' the referential constraint \'Dingus\'.';
        $this->assertEquals($expected, $error->getErrorMessage());
    }
}
