<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27/07/20
 * Time: 4:00 AM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyWithRecursiveContainmentTargetMustBeOptional;
use AlgoWeb\ODataMetadata\Exception\ArgumentNullException;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class NavigationPropertyWithRecursiveContainmentTargetMustBeOptionalTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvokeWithNullLocation()
    {
        $contains = true;
        $isOrInherits = true;
        $isCollection = false;
        $isNullable = false;

        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $eType = m::mock(IEntityType::class);

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('isCollection')->andReturn($isCollection);
        $typeRef->shouldReceive('getNullable')->andReturn($isNullable);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('containsTarget')->andReturn($contains);
        $element->shouldReceive('getDeclaringType->isOrInheritsFrom')->andReturn($isOrInherits);
        $element->shouldReceive('toEntityType')->andReturn($eType);
        $element->shouldReceive('getType')->andReturn($typeRef);
        $element->shouldReceive('location')->andReturn(null);

        $foo = new NavigationPropertyWithRecursiveContainmentTargetMustBeOptional();

        $this->expectException(ArgumentNullException::class);
        $this->expectExceptionMessage('Value for parameter property->Location cannot be null.');

        $foo->__invoke($context, $element);
    }

    public function invokeProvider(): array
    {
        $result = [];
        $result[] = [true, true, false, false, 1];
        $result[] = [true, true, false, true, 0];
        $result[] = [true, true, true, false, 0];
        $result[] = [true, true, true, true, 0];
        $result[] = [true, false, false, false, 0];
        $result[] = [true, false, false, true, 0];
        $result[] = [true, false, true, false, 0];
        $result[] = [true, false, true, true, 0];
        $result[] = [false, true, false, false, 0];
        $result[] = [false, true, false, true, 0];
        $result[] = [false, true, true, false, 0];
        $result[] = [false, true, true, true, 0];
        $result[] = [false, false, false, false, 0];
        $result[] = [false, false, false, true, 0];
        $result[] = [false, false, true, false, 0];
        $result[] = [false, false, true, true, 0];

        return $result;
    }

    /**
     * @dataProvider invokeProvider
     *
     * @param bool $contains
     * @param bool $isOrInherits
     * @param bool $isCollection
     * @param bool $isNullable
     * @param int $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeRecursiveContainment(
        bool $contains,
        bool $isOrInherits,
        bool $isCollection,
        bool $isNullable,
        int $numErrors
    ) {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $eType = m::mock(IEntityType::class);

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('isCollection')->andReturn($isCollection);
        $typeRef->shouldReceive('getNullable')->andReturn($isNullable);

        $loc = m::mock(ILocation::class);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('containsTarget')->andReturn($contains);
        $element->shouldReceive('getDeclaringType->isOrInheritsFrom')->andReturn($isOrInherits);
        $element->shouldReceive('toEntityType')->andReturn($eType);
        $element->shouldReceive('getType')->andReturn($typeRef);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('getName')->andReturn('navProp');

        $foo = new NavigationPropertyWithRecursiveContainmentTargetMustBeOptional();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals($numErrors, count($errors));
        if (1 === $numErrors) {
            $error = $errors[0];
            $errorCode = EdmErrorCode::NavigationPropertyWithRecursiveContainmentTargetMustBeOptional();
            $this->assertEquals($errorCode, $error->getErrorCode());
            $expected = 'The target multiplicity of the navigation property \'navProp\' is invalid. If a navigation'
                        .' property has \'ContainsTarget\' set to true and declaring entity type of the property is the'
                        .' same or inherits from the target entity type, then the property represents a recursive'
                        .' containment and it must have an optional target represented by a collection or a nullable'
                        .' entity type.';
            $actual = $error->getErrorMessage();
            $this->assertEquals($expected, $actual);
        }
    }
}
