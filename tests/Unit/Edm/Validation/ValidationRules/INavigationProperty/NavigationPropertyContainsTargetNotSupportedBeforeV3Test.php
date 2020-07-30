<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30/07/20
 * Time: 5:14 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyContainsTargetNotSupportedBeforeV3;
use Mockery as m;

class NavigationPropertyContainsTargetNotSupportedBeforeV3Test extends TestCase
{
    public function containsProvider(): array
    {
        $result = [];
        $result[] = [true, 1];
        $result[] = [false, 0];

        return $result;
    }

    /**
     * @dataProvider containsProvider
     *
     * @param bool $contains
     * @param int $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeContainsTarget(bool $contains, int $numErrors)
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('containsTarget')->andReturn($contains);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('getName')->andReturn('navProp');

        $foo = new NavigationPropertyContainsTargetNotSupportedBeforeV3();

        $foo->__invoke($context, $element);

        $this->assertEquals($numErrors, count($context->getErrors()));
        if (1 === $numErrors) {
            $error = $context->getErrors()[0];
            $errorCode = EdmErrorCode::NavigationPropertyContainsTargetNotSupportedBeforeV3();
            $this->assertEquals($errorCode, $error->getErrorCode());

            $expected = 'The \'ContainsTarget\' setting of navigation properties is not supported before version 3.0.';
            $this->assertEquals($expected, $error->getErrorMessage());
        }
    }
}
