<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27/07/20
 * Time: 5:10 PM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyDependentEndMultiplicity;
use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;
use PhpParser\Node\Expr\AssignOp\Mul;

class NavigationPropertyDependentEndMultiplicityTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvokeNullDependentProperties()
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('getDependentProperties')->andReturn(null);
        $element->shouldReceive('location')->andReturn($loc);

        $foo = new NavigationPropertyDependentEndMultiplicity();

        $foo->__invoke($context, $element);

        $this->assertEquals(0, count($context->getErrors()));
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokeEmptyDependentProperties()
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('getDependentProperties')->andReturn([]);
        $element->shouldReceive('location')->andReturn($loc);

        $foo = new NavigationPropertyDependentEndMultiplicity();

        $foo->__invoke($context, $element);

        $this->assertEquals(0, count($context->getErrors()));
    }

    public function equivalentProvider(): array
    {
        $result   = [];
        $result[] = [Multiplicity::One(), 0];
        $result[] = [Multiplicity::ZeroOrOne(), 0];
        $result[] = [Multiplicity::Many(), 1];

        return $result;
    }

    /**
     * @dataProvider equivalentProvider
     *
     * @param  Multiplicity         $mult
     * @param  int                  $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeEquivalentDependentProperties(Multiplicity $mult, int $numErrors)
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);

        $prop1 = m::mock(IStructuralProperty::class);

        $eType = m::mock(IEntityType::class);
        $eType->shouldReceive('key')->andReturn([$prop1]);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('getDependentProperties')->andReturn([$prop1]);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('declaringEntityType')->andReturn($eType);
        $element->shouldReceive('multiplicity')->andReturn($mult);
        $element->shouldReceive('getName')->andReturn('navProp');

        $foo = new NavigationPropertyDependentEndMultiplicity();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals($numErrors, count($errors));
        if (1 === $numErrors) {
            $error     = $errors[0];
            $errorCode = EdmErrorCode::InvalidMultiplicityOfDependentEnd();
            $this->assertEquals($errorCode, $error->getErrorCode());
            $expected = 'The multiplicity of the dependent end \'navProp\' is not valid. Because the dependent'
                        . ' properties represent the dependent end key, the multiplicity of the dependent end'
                        . ' must be \'0..1\' or \'1\'.';
            $this->assertEquals($expected, $error->getErrorMessage());
        }
    }

    public function nonEquivalentProvider(): array
    {
        $result   = [];
        $result[] = [Multiplicity::One(), 1];
        $result[] = [Multiplicity::ZeroOrOne(), 1];
        $result[] = [Multiplicity::Many(), 0];

        return $result;
    }

    /**
     * @dataProvider nonEquivalentProvider
     *
     * @param  Multiplicity         $mult
     * @param  int                  $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeNonEquivalentDependentProperties(Multiplicity $mult, int $numErrors)
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);

        $prop1 = m::mock(IStructuralProperty::class);

        $eType = m::mock(IEntityType::class);
        $eType->shouldReceive('key')->andReturn([]);

        $element = m::mock(INavigationProperty::class);
        $element->shouldReceive('getDependentProperties')->andReturn([$prop1]);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('declaringEntityType')->andReturn($eType);
        $element->shouldReceive('multiplicity')->andReturn($mult);
        $element->shouldReceive('getName')->andReturn('navProp');

        $foo = new NavigationPropertyDependentEndMultiplicity();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals($numErrors, count($errors));
        if (1 === $numErrors) {
            $error     = $errors[0];
            $errorCode = EdmErrorCode::InvalidMultiplicityOfDependentEnd();
            $this->assertEquals($errorCode, $error->getErrorCode());
            $expected = 'The multiplicity of the dependent end \'navProp\' is not valid. Because the dependent'
                        . ' properties don\'t represent the dependent end key, the the multiplicity of the dependent'
                        . ' end must be \'*\'.';
            $this->assertEquals($expected, $error->getErrorMessage());
        }
    }
}
