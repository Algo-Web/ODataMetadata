<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30/07/20
 * Time: 11:10 AM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyInvalidOperationMultipleEndsInAssociation;
use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Enums\OnDeleteAction;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class NavigationPropertyInvalidOperationMultipleEndsInAssociationTest extends TestCase
{
    public function onDeleteProvider(): array
    {
        $result = [];
        $result[] = [OnDeleteAction::Cascade(), OnDeleteAction::Cascade(), 1];
        $result[] = [OnDeleteAction::None(), OnDeleteAction::Cascade(), 0];
        $result[] = [OnDeleteAction::Cascade(), OnDeleteAction::None(), 0];
        $result[] = [OnDeleteAction::None(), OnDeleteAction::None(), 0];

        return $result;
    }

    /**
     * @dataProvider onDeleteProvider
     *
     * @param OnDeleteAction $onDelete
     * @param OnDeleteAction $partnerDelete
     * @param int $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeWithOnDelete(OnDeleteAction $onDelete, OnDeleteAction $partnerDelete, int $numErrors)
    {
        $callable = function (IEdmElement $one): bool { return false; };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);

        $partner = m::mock(INavigationProperty::class);
        $partner->shouldReceive('getOnDelete')->andReturn($partnerDelete);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('getOnDelete')->andReturn($onDelete);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('getName')->andReturn('navProp');
        $element->shouldReceive('getPartner')->andReturn($partner);

        $foo = new NavigationPropertyInvalidOperationMultipleEndsInAssociation();

        $foo->__invoke($context, $element);

        $this->assertEquals($numErrors, count($context->getErrors()));
        if (1 === $numErrors) {
            $error = $context->getErrors()[0];
            $errorCode = EdmErrorCode::InvalidAction();
            $this->assertEquals($errorCode, $error->getErrorCode());

            $expected = 'An on delete action can only be specified on one end of an association.';
            $this->assertEquals($expected, $error->getErrorMessage());
        }
    }
}
