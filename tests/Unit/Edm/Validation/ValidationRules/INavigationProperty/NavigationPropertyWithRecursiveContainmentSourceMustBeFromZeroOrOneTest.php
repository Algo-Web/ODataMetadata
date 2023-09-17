<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30/07/20
 * Time: 3:41 AM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyWithRecursiveContainmentSourceMustBeFromZeroOrOne;
use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class NavigationPropertyWithRecursiveContainmentSourceMustBeFromZeroOrOneTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvokeBadMultiplicity()
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $eType = m::mock(IEntityType::class);
        $eType->shouldReceive('isOrInheritsFrom')->andReturn(true);
        $decType = m::mock(IStructuredType::class);
        $decType->shouldReceive('isOrInheritsFrom')->andReturn(true);

        $loc = m::mock(ILocation::class);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('containsTarget')->andReturn(true);
        $element->shouldReceive('getDeclaringType')->andReturn($decType);
        $element->shouldReceive('toEntityType')->andReturn($eType);
        $element->shouldReceive('declaringEntityType')->andReturn($eType);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('getName')->andReturn('navProp');
        $element->shouldReceive('multiplicity')->andReturn(Multiplicity::Unknown());

        $foo = new NavigationPropertyWithRecursiveContainmentSourceMustBeFromZeroOrOne();

        $foo->__invoke($context, $element);

        $this->assertEquals(1, count($context->getErrors()));
        $error     = $context->getErrors()[0];
        $errorCode = EdmErrorCode::NavigationPropertyWithRecursiveContainmentSourceMustBeFromZeroOrOne();
        $this->assertEquals($errorCode, $error->getErrorCode());

        $expected = 'The source multiplicity of the navigation property \'navProp\' is invalid. If a navigation'
                    . ' property has \'ContainsTarget\' set to true and declaring entity type of the property is the' .
                    ' same or inherits from the target entity type, then the property represents a recursive' .
                    ' containment and the multiplicity of the navigation source must be zero or one.';
        $actual = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }
}
