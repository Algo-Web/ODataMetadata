<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30/07/20
 * Time: 5:39 PM
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
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyAssociationNameIsValid;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class NavigationPropertyAssociationNameIsValidTest extends TestCase
{
    public function principalProvider(): array
    {
        $result = [];
        $result[] = [true, 1];
        $result[] = [false, 0];

        return $result;
    }

    /**
     * @dataProvider principalProvider
     *
     * @param bool $isPrincipal
     * @param int $numErrors
     * @throws \ReflectionException
     */
    public function testInvokePrincipal(bool $isPrincipal, int $numErrors)
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);
        $model->shouldReceive('getAssociationName')->andReturn(' Thats Not\/My/Name');

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('isPrincipal')->andReturn($isPrincipal);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('getName')->andReturn('navProp');

        $foo = new NavigationPropertyAssociationNameIsValid();

        $foo->__invoke($context, $element);

        $this->assertEquals($numErrors, count($context->getErrors()));
        if (1 === $numErrors) {
            $error = $context->getErrors()[0];
            $errorCode = EdmErrorCode::InvalidName();
            $this->assertEquals($errorCode, $error->getErrorCode());

            $expected = 'The specified name is not allowed: \' Thats Not\/My/Name\'.';
            $this->assertEquals($expected, $error->getErrorMessage());
        }
    }
}
