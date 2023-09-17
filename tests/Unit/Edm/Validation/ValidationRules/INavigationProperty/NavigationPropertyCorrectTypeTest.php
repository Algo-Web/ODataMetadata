<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 26/07/20
 * Time: 5:49 PM.
 */

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty\NavigationPropertyCorrectType;
use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class NavigationPropertyCorrectTypeTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testEntityTypeMismatch()
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };

        $model = m::mock(IModel::class);
        $foo   = new NavigationPropertyCorrectType();

        $oneType = m::mock(IEntityType::class);
        $twoType = m::mock(IEntityType::class);
        $this->assertFalse($oneType === $twoType);

        $loc = m::mock(ILocation::class);

        $prop = m::mock(INavigationProperty::class);
        $prop->shouldReceive('location')->andReturn($loc);
        $prop->shouldReceive('getName')->andReturn('name');
        $prop->shouldReceive('toEntityType')->andReturn($oneType);
        $prop->shouldReceive('getPartner->declaringEntityType')->andReturn($twoType);
        $prop->shouldReceive('getPartner->multiplicity')->andReturnNull()->never();

        $context = new ValidationContext($model, $callable);

        $foo->__invoke($context, $prop);
        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error     = $errors[0];
        $errorCode = EdmErrorCode::InvalidNavigationPropertyType();
        $this->assertEquals($errorCode, $error->getErrorCode());
        $expected = 'The type of the navigation property \'name\' is invalid. The navigation target type must be an'
                    . ' entity type or a collection of entity type. The navigation target entity type must match the'
                    . ' declaring type of the partner property.';
        $this->assertEquals($expected, $error->getErrorMessage());
    }

    public function multiplicityProvider(): array
    {
        $result   = [];
        $result[] = [Multiplicity::Many(), true, true, 0];
        $result[] = [Multiplicity::Many(), true, false, 0];
        $result[] = [Multiplicity::Many(), false, true, 1];
        $result[] = [Multiplicity::Many(), false, false, 1];
        $result[] = [Multiplicity::ZeroOrOne(), true, true, 1];
        $result[] = [Multiplicity::ZeroOrOne(), true, false, 1];
        $result[] = [Multiplicity::ZeroOrOne(), false, true, 0];
        $result[] = [Multiplicity::ZeroOrOne(), false, false, 1];
        $result[] = [Multiplicity::One(), true, true, 1];
        $result[] = [Multiplicity::One(), true, false, 1];
        $result[] = [Multiplicity::One(), false, true, 1];
        $result[] = [Multiplicity::One(), false, false, 0];

        return $result;
    }

    /**
     * @dataProvider multiplicityProvider
     *
     * @param  Multiplicity         $mult
     * @param  bool                 $isCollection
     * @param  bool                 $isNullable
     * @param  int                  $numErrors
     * @throws \ReflectionException
     */
    public function testMultiplicity(Multiplicity $mult, bool $isCollection, bool $isNullable, int $numErrors)
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };

        $model = m::mock(IModel::class);
        $foo   = new NavigationPropertyCorrectType();

        $oneType = m::mock(IEntityType::class);

        $loc = m::mock(ILocation::class);

        $partner = m::mock(INavigationProperty::class);
        $partner->shouldReceive('declaringEntityType')->andReturn($oneType);
        $partner->shouldReceive('multiplicity')->andReturn($mult)->once();

        $propType = m::mock(ITypeReference::class);
        $propType->shouldReceive('isCollection')->andReturn($isCollection);
        $propType->shouldReceive('getNullable')->andReturn($isNullable);

        $prop = m::mock(INavigationProperty::class);
        $prop->shouldReceive('location')->andReturn($loc);
        $prop->shouldReceive('getName')->andReturn('name');
        $prop->shouldReceive('toEntityType')->andReturn($oneType);
        $prop->shouldReceive('getPartner')->andReturn($partner);
        $prop->shouldReceive('getType')->andReturn($propType);

        $context = new ValidationContext($model, $callable);

        $foo->__invoke($context, $prop);
        $errors = $context->getErrors();
        $this->assertEquals($numErrors, count($errors));
        if (1 === $numErrors) {
            $error     = $errors[0];
            $errorCode = EdmErrorCode::InvalidNavigationPropertyType();
            $this->assertEquals($errorCode, $error->getErrorCode());
            $expected = 'The type of the navigation property \'name\' is invalid. The navigation target type must be an'
                        . ' entity type or a collection of entity type. The navigation target entity type must match the'
                        . ' declaring type of the partner property.';
            $this->assertEquals($expected, $error->getErrorMessage());
        }
    }
}
