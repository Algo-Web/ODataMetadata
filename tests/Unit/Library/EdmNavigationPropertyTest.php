<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 6/07/20
 * Time: 3:39 AM.
 */
namespace AlgoWeb\ODataMetadata\Tests\Unit\Library;

use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Enums\OnDeleteAction;
use AlgoWeb\ODataMetadata\Exception\ArgumentException;
use AlgoWeb\ODataMetadata\Exception\ArgumentOutOfRangeException;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Library\EdmEntityTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmNavigationProperty;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class EdmNavigationPropertyTest extends TestCase
{
    public function testCreateNavigationPropertyWithPartnerBadPartnerType()
    {
        $propertyName        = 'propName';
        $propType            = m::mock(ITypeReference::class);
        $onDelete            = OnDeleteAction::None();
        $partnerPropertyName = 'partnerPropName';
        $partnerPropType     = m::mock(ITypeReference::class);
        $partnerPropType->shouldReceive('IsEntity')->andReturn(false);
        $partnerPropType->shouldReceive('IsCollection')->andReturn(false);
        $partnerOnDelete = OnDeleteAction::None();

        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('An entity type or a collection of an entity type is expected.');

        EdmNavigationProperty::CreateNavigationPropertyWithPartner(
            $propertyName,
            $propType,
            [],
            false,
            $onDelete,
            $partnerPropertyName,
            $partnerPropType,
            [],
            false,
            $partnerOnDelete
        );
    }

    public function testCreateNavigationPropertyWithPartnerBadMainType()
    {
        $propertyName = 'propName';
        $propType     = m::mock(ITypeReference::class);
        $propType->shouldReceive('IsEntity')->andReturn(false);
        $propType->shouldReceive('IsCollection')->andReturn(false);
        $onDelete            = OnDeleteAction::None();
        $partnerPropertyName = 'partnerPropName';

        $def             = m::mock(IEntityType::class);
        $partnerPropType = m::mock(ITypeReference::class);
        $partnerPropType->shouldReceive('IsEntity')->andReturn(true);
        $partnerPropType->shouldReceive('IsCollection')->andReturn(false)->never();
        $partnerPropType->shouldReceive('getDefinition')->andReturn($def);
        $partnerOnDelete = OnDeleteAction::None();

        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('An entity type or a collection of an entity type is expected.');

        EdmNavigationProperty::CreateNavigationPropertyWithPartner(
            $propertyName,
            $propType,
            [],
            false,
            $onDelete,
            $partnerPropertyName,
            $partnerPropType,
            [],
            false,
            $partnerOnDelete
        );
    }

    public function testCreateNavigationPropertyWithPartnerGoodMainType()
    {
        $propertyName = 'propName';

        $eDef  = m::mock(IEntityType::class);
        $eType = m::mock(ITypeReference::class);
        $eType->shouldReceive('IsEntity')->andReturn(true);
        $eType->shouldReceive('getDefinition')->andReturn($eDef);

        $def = m::mock(ICollectionType::class);
        $def->shouldReceive('getElementType')->andReturn($eType);

        $propType = m::mock(ITypeReference::class);
        $propType->shouldReceive('IsEntity')->andReturn(false);
        $propType->shouldReceive('IsCollection')->andReturn(true);
        $propType->shouldReceive('getDefinition')->andReturn($def);
        $onDelete            = OnDeleteAction::None();
        $partnerPropertyName = 'partnerPropName';

        $def             = m::mock(IEntityType::class);
        $partnerPropType = m::mock(ITypeReference::class);
        $partnerPropType->shouldReceive('IsEntity')->andReturn(true);
        $partnerPropType->shouldReceive('IsCollection')->andReturn(false)->never();
        $partnerPropType->shouldReceive('getDefinition')->andReturn($def);
        $partnerOnDelete = OnDeleteAction::None();

        $result = EdmNavigationProperty::CreateNavigationPropertyWithPartner(
            $propertyName,
            $propType,
            [],
            false,
            $onDelete,
            $partnerPropertyName,
            $partnerPropType,
            [],
            false,
            $partnerOnDelete
        );

        $partner = $result->getPartner();
        $this->assertEquals($result, $partner->getPartner());
    }

    /**
     * @throws \ReflectionException
     */
    public function testCreateNavigationPropertyType()
    {
        $eType = m::mock(IEntityType::class);
        $mult  = Multiplicity::ZeroOrOne();
        $name  = 'name';

        $reflec = new \ReflectionClass(EdmNavigationProperty::class);

        $method = $reflec->getMethod('CreateNavigationPropertyType');
        $this->assertTrue($method->isStatic());
        $method->setAccessible(true);

        /** @var EdmEntityTypeReference $res */
        $res = $method->invoke(null, $eType, $mult, $name);
        $this->assertTrue($res instanceof EdmEntityTypeReference);
        $this->assertTrue($res->getNullable());
    }

    /**
     * @throws \ReflectionException
     */
    public function testCreateNavigationPropertyTypeBadMult()
    {
        $eType = m::mock(IEntityType::class);
        $mult  = Multiplicity::Unknown();
        $name  = 'name';

        $reflec = new \ReflectionClass(EdmNavigationProperty::class);

        $method = $reflec->getMethod('CreateNavigationPropertyType');
        $this->assertTrue($method->isStatic());
        $method->setAccessible(true);

        $this->expectException(ArgumentOutOfRangeException::class);
        $this->expectExceptionMessage('Invalid multiplicity: \'Unknown\'');

        /** @var EdmEntityTypeReference $res */
        $method->invoke(null, $eType, $mult, $name);
    }
}
