<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26/07/20
 * Time: 6:41 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyPrincipalEndMultiplicity;
use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Exception\ArgumentNullException;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class NavigationPropertyPrincipalEndMultiplicityTest extends TestCase
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

        $foo = new NavigationPropertyPrincipalEndMultiplicity();

        $foo->__invoke($context, $element);

        $this->assertEquals(0, count($context->getErrors()));
    }

    public function testInvokeNullLocation()
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('getDependentProperties')->andReturn([]);
        $element->shouldReceive('getPartner->location')->andReturn(null);

        $foo = new NavigationPropertyPrincipalEndMultiplicity();

        $this->expectException(ArgumentNullException::class);
        $this->expectExceptionMessage('Value for parameter navigationProperty->getPartner->Location cannot be null');
        $foo->__invoke($context, $element);
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokeAllNullableButNotZeroOrOne()
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);
        $partner = m::mock(INavigationProperty::class);
        $partner->shouldReceive('location')->andReturn($loc);
        $partner->shouldReceive('multiplicity')->andReturn(Multiplicity::Unknown());
        $partner->shouldReceive('getName')->andReturn('partner');

        $dependentProperties = [];

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('getDependentProperties')->andReturn($dependentProperties);
        $element->shouldReceive('getPartner')->andReturn($partner);
        $element->shouldReceive('getName')->andReturn('element');

        $this->assertTrue(ValidationHelper::allPropertiesAreNullable($dependentProperties));

        $foo = new NavigationPropertyPrincipalEndMultiplicity();

        $foo->__invoke($context, $element);

        $this->assertEquals(1, count($context->getErrors()));
        $error = $context->getErrors()[0];
        $errorCode = EdmErrorCode::InvalidMultiplicityOfPrincipalEnd();
        $this->assertEquals($errorCode, $error->getErrorCode());

        $expected = 'The multiplicity of the principal end \'partner\' is not valid. Because all dependent properties'.
                    ' of the end \'element\' are nullable, the multiplicity of the principal end must be \'0..1\'.';
        $actual = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokeNoneNullableButNotOne()
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);
        $partner = m::mock(INavigationProperty::class);
        $partner->shouldReceive('location')->andReturn($loc);
        $partner->shouldReceive('multiplicity')->andReturn(Multiplicity::Unknown());
        $partner->shouldReceive('getName')->andReturn('partner');

        $prop1 = m::mock(IStructuralProperty::class);
        $prop1->shouldReceive('getType->getNullable')->andReturn(false);

        $dependentProperties = [$prop1];

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('getDependentProperties')->andReturn($dependentProperties);
        $element->shouldReceive('getPartner')->andReturn($partner);
        $element->shouldReceive('getName')->andReturn('element');

        $this->assertFalse(ValidationHelper::allPropertiesAreNullable($dependentProperties));
        $this->assertFalse(ValidationHelper::hasNullableProperty($dependentProperties));

        $foo = new NavigationPropertyPrincipalEndMultiplicity();

        $foo->__invoke($context, $element);

        $this->assertEquals(1, count($context->getErrors()));
        $error = $context->getErrors()[0];
        $errorCode = EdmErrorCode::InvalidMultiplicityOfPrincipalEnd();
        $this->assertEquals($errorCode, $error->getErrorCode());

        $expected = 'The multiplicity of the principal end \'partner\' is not valid. Because all dependent properties'.
                    ' of the end \'element\' are non-nullable, the multiplicity of the principal end must be \'1\'.';
        $actual = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokeSomeNullableButNotMany()
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);
        $partner = m::mock(INavigationProperty::class);
        $partner->shouldReceive('location')->andReturn($loc);
        $partner->shouldReceive('multiplicity')->andReturn(Multiplicity::Unknown());
        $partner->shouldReceive('getName')->andReturn('partner');

        $prop1 = m::mock(IStructuralProperty::class);
        $prop1->shouldReceive('getType->getNullable')->andReturn(false);
        $prop2 = m::mock(IStructuralProperty::class);
        $prop2->shouldReceive('getType->getNullable')->andReturn(true);

        $dependentProperties = [$prop1, $prop2];

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('getDependentProperties')->andReturn($dependentProperties);
        $element->shouldReceive('getPartner')->andReturn($partner);
        $element->shouldReceive('getName')->andReturn('element');

        $this->assertFalse(ValidationHelper::allPropertiesAreNullable($dependentProperties));
        $this->assertTrue(ValidationHelper::hasNullableProperty($dependentProperties));

        $foo = new NavigationPropertyPrincipalEndMultiplicity();

        $foo->__invoke($context, $element);

        $this->assertEquals(1, count($context->getErrors()));
        $error = $context->getErrors()[0];
        $errorCode = EdmErrorCode::InvalidMultiplicityOfPrincipalEnd();
        $this->assertEquals($errorCode, $error->getErrorCode());

        $expected = 'The principal navigation property \'element\' has an invalid multiplicity. Valid values for the'
                    .' multiplicity of a principal end are \'0..1\' or \'1\'.';
        $actual = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }
}
