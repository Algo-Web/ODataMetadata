<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30/07/20
 * Time: 10:47 AM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Enums\OnDeleteAction;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyEndWithManyMultiplicityCannotHaveOperationsSpecified;
use Mockery as m;

class NavigationPropertyEndWithManyMultiplicityCannotHaveOperationsSpecifiedTest extends TestCase
{
    public function onDeleteProvider(): array
    {
        $result = [];
        $result[] = [Multiplicity::Many(), OnDeleteAction::Cascade(), 1];
        $result[] = [Multiplicity::Unknown(), OnDeleteAction::Cascade(), 0];
        $result[] = [Multiplicity::Many(), OnDeleteAction::None(), 0];
        $result[] = [Multiplicity::Unknown(), OnDeleteAction::None(), 0];

        return $result;
    }

    /**
     * @dataProvider onDeleteProvider
     *
     * @param Multiplicity $mult
     * @param OnDeleteAction $onDelete
     * @param int $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeWithOnDelete(Multiplicity $mult, OnDeleteAction $onDelete, int $numErrors)
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('multiplicity')->andReturn($mult);
        $element->shouldReceive('getOnDelete')->andReturn($onDelete);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('getName')->andReturn('navProp');

        $foo = new NavigationPropertyEndWithManyMultiplicityCannotHaveOperationsSpecified();

        $foo->__invoke($context, $element);

        $this->assertEquals($numErrors, count($context->getErrors()));
        if (1 === $numErrors) {
            $error = $context->getErrors()[0];
            $errorCode = EdmErrorCode::EndWithManyMultiplicityCannotHaveOperationsSpecified();
            $this->assertEquals($errorCode, $error->getErrorCode());

            $expected = 'The navigation property \'navProp\' cannot have \'OnDelete\' specified since its'
                        .' multiplicity is \'*\'.';
            $this->assertEquals($expected, $error->getErrorMessage());
        }
    }
}
