<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 8/07/20
 * Time: 3:49 PM.
 */
namespace AlgoWeb\ODataMetadata\Tests\Unit\Helpers;

use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Library\EdmModel;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Version;
use Mockery as m;

class ModelTypeHelpersTest extends TestCase
{
    public function testFindEntityContainer()
    {
        $foo = new EdmModel();

        $expected = null;
        $actual   = $foo->findEntityContainer('name');
        $this->assertEquals($expected, $actual);
    }

    public function testFindValueTerm()
    {
        $foo = new EdmModel();

        $expected = null;
        $actual   = $foo->findValueTerm('name');
        $this->assertEquals($expected, $actual);
    }

    public function testFindFunctions()
    {
        $foo = new EdmModel();

        $expected = [];
        $actual   = $foo->findFunctions('name');
        $this->assertEquals($expected, $actual);
    }

    public function testFindType()
    {
        $foo = new EdmModel();

        $expected = null;
        $actual   = $foo->findType('name');
        $this->assertEquals($expected, $actual);
    }

    public function testSetEdmVersionRoundTrip()
    {
        $expected = Version::v2();

        $foo = new EdmModel();
        $foo->setEdmVersion($expected);
        $actual = $foo->getEdmVersion();
        $this->assertEquals($expected, $actual);
    }

    public function testSetEdmxVersionRoundTrip()
    {
        $expected = Version::v2();

        $foo = new EdmModel();
        $foo->setEdmxVersion($expected);
        $actual = $foo->getEdmxVersion();
        $this->assertEquals($expected, $actual);
    }

    public function testSetDataServiceVersionRoundTrip()
    {
        $expected = Version::v2();

        $foo = new EdmModel();
        $foo->setDataServiceVersion($expected);
        $actual = $foo->getDataServiceVersion();
        $this->assertEquals($expected, $actual);
    }

    public function testSetMaxDataServiceVersionRoundTrip()
    {
        $expected = Version::v2();

        $foo = new EdmModel();
        $foo->setMaxDataServiceVersion($expected);
        $actual = $foo->getMaxDataServiceVersion();
        $this->assertEquals($expected, $actual);
    }

    public function testSetNamespacePrefixMappings()
    {
        $expected = [];
        $foo      = new EdmModel();
        $actual   = $foo->getNamespacePrefixMappings();
        $this->assertEquals($expected, $actual);

        $expected = ['foo'];
        $foo->setNamespacePrefixMappings($expected);
        $actual = $foo->getNamespacePrefixMappings();
        $this->assertEquals($expected, $actual);
    }

    public function testSetAssociationEndNameRoundTrip()
    {
        $prop = m::mock(INavigationProperty::class);
        $prop->shouldReceive('PopulateCaches')->once();
        $foo = new EdmModel();

        $assoc = 'assoc';

        $foo->setAssociationEndName($prop, $assoc);

        $expected = 'assoc';
        $actual   = $foo->getAssociationEndName($prop);
        $this->assertEquals($expected, $actual);
    }

    public function testSetAssociationNameRoundTrip()
    {
        $prop = m::mock(INavigationProperty::class);
        $prop->shouldReceive('PopulateCaches')->once();
        $foo = new EdmModel();

        $assoc = 'assoc';

        $foo->setAssociationName($prop, $assoc);

        $expected = 'assoc';
        $actual   = $foo->getAssociationName($prop);
        $this->assertEquals($expected, $actual);
    }

    public function testSetAssociationNamespaceRoundTrip()
    {
        $prop = m::mock(INavigationProperty::class);
        $prop->shouldReceive('PopulateCaches')->once();
        $foo = new EdmModel();

        $assoc = 'assoc';

        $foo->setAssociationNamespace($prop, $assoc);

        $expected = 'assoc';
        $actual   = $foo->getAssociationNamespace($prop);
        $this->assertEquals($expected, $actual);
    }

    public function testSetAssociationSetNameRoundTrip()
    {
        $set  = m::mock(IEntitySet::class);
        $prop = m::mock(INavigationProperty::class);
        $prop->shouldReceive('PopulateCaches')->once();
        $foo = new EdmModel();

        $assoc = 'assoc';

        $foo->setAssociationSetName($set, $prop, $assoc);

        $expected = 'assoc';
        $actual   = $foo->getAssociationSetName($set, $prop);
        $this->assertEquals($expected, $actual);
    }

    public function testFindAllDerivedTypesNonSchema()
    {
        $baseType = m::mock(IStructuredType::class);

        $foo = new EdmModel();

        $expected = [];
        $actual   = $foo->findAllDerivedTypes($baseType);
        $this->assertEquals($expected, $actual);
    }

    public function testFindAllDerivedTypesSchemaNothing()
    {
        $baseType = m::mock(IStructuredType::class . ', ' . ISchemaElement::class);

        $foo = new EdmModel();

        $expected = [];
        $actual   = $foo->findAllDerivedTypes($baseType);
        $this->assertEquals($expected, $actual);
    }

    public function testFindAllDerivedTypesSchemaSingleBase()
    {
        $baseType = m::mock(IStructuredType::class . ', ' . ISchemaElement::class . ', ' . IEntityContainer::class);
        $baseType->shouldReceive('getBaseType')->andReturn(null);
        $baseType->shouldReceive('FullName')->andReturn('base');
        $baseType->shouldReceive('getName')->andReturn('base');
        $baseType->shouldReceive('getNamespace')->andReturn('namespace');
        $baseType->shouldReceive('getSchemaElementKind')
            ->andReturn(SchemaElementKind::EntityContainer());

        $derived = m::mock(IStructuredType::class . ', ' . ISchemaElement::class . ', ' . IEntityContainer::class);
        $derived->shouldReceive('getBaseType')->andReturn($baseType);
        $derived->shouldReceive('FullName')->andReturn('derived');
        $derived->shouldReceive('getName')->andReturn('derived');
        $derived->shouldReceive('getNamespace')->andReturn('namespace');
        $derived->shouldReceive('getSchemaElementKind')
            ->andReturn(SchemaElementKind::EntityContainer());

        $foo = new EdmModel();
        $foo->addElement($baseType);
        $foo->addElement($derived);

        $res = $foo->findDirectlyDerivedTypes($baseType);
        $this->assertEquals(0, count($res));

        $expected = [];
        $actual   = $foo->findAllDerivedTypes($derived);
        $this->assertEquals($expected, $actual);
    }
}
