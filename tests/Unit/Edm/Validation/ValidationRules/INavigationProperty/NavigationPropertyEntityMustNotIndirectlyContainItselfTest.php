<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30/07/20
 * Time: 3:16 AM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyEntityMustNotIndirectlyContainItself;
use Mockery as m;

class NavigationPropertyEntityMustNotIndirectlyContainItselfTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvokeDoesContainSelf()
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $eType = m::mock(IEntityType::class);
        $eType->shouldReceive('isOrInheritsFrom')->andReturn(true);
        $decType = m::mock(IStructuredType::class);
        $decType->shouldReceive('isOrInheritsFrom')->andReturn(false);

        $loc = m::mock(ILocation::class);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('containsTarget')->andReturn(true);
        $element->shouldReceive('getDeclaringType')->andReturn($decType);
        $element->shouldReceive('toEntityType')->andReturn($eType);
        $element->shouldReceive('declaringEntityType')->andReturn($eType);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('getName')->andReturn('navProp');

        $foo = new NavigationPropertyEntityMustNotIndirectlyContainItself();

        $foo->__invoke($context, $element);

        $this->assertEquals(1, count($context->getErrors()));
        $error = $context->getErrors()[0];
        $errorCode = EdmErrorCode::NavigationPropertyEntityMustNotIndirectlyContainItself();
        $this->assertEquals($errorCode, $error->getErrorCode());

        $expected = 'The navigation property \'navProp\' is invalid because it indirectly contains itself.';
        $actual = $error->getErrorMessage();
        $this->assertEquals($expected, $actual);
    }
}
