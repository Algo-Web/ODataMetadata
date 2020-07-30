<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30/07/20
 * Time: 5:54 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyAssociationNameIsValid;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyAssociationEndNameIsValid;
use Mockery as m;

class NavigationPropertyAssociationEndNameIsValidTest extends TestCase
{
    public function nameProvider(): array
    {
        $result = [];
        $result[] = ['name', 0];
        $result[] = ['  ', 1];
        $result[] = ['', 1];

        return $result;
    }

    /**
     * @dataProvider nameProvider
     *
     * @param string|null $name
     * @param int $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeValidName(?string $name, int $numErrors)
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);
        $model->shouldReceive('getAssociationEndName')->andReturn($name);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('getName')->andReturn('navProp');

        $foo = new NavigationPropertyAssociationEndNameIsValid();

        $foo->__invoke($context, $element);

        $this->assertEquals($numErrors, count($context->getErrors()));
        if (1 === $numErrors) {
            $error = $context->getErrors()[0];
            $errorCode = EdmErrorCode::InvalidName();
            $this->assertEquals($errorCode, $error->getErrorCode());

            $expected = 'The name is missing or not valid.';
            $this->assertEquals($expected, $error->getErrorMessage());
        }
    }
}
