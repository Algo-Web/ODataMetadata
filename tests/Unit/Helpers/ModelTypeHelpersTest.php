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
        $actual   = $foo->FindEntityContainer('name');
        $this->assertEquals($expected, $actual);
    }

    public function testFindValueTerm()
    {
        $foo = new EdmModel();

        $expected = null;
        $actual   = $foo->FindValueTerm('name');
        $this->assertEquals($expected, $actual);
    }

    public function testFindFunctions()
    {
        $foo = new EdmModel();

        $expected = [];
        $actual   = $foo->FindFunctions('name');
        $this->assertEquals($expected, $actual);
    }

    public function testFindType()
    {
        $foo = new EdmModel();

        $expected = null;
        $actual   = $foo->FindType('name');
        $this->assertEquals($expected, $actual);
    }

    public function testSetEdmVersionRoundTrip()
    {
        $expected = Version::v2();

        $foo = new EdmModel();
        $foo->SetEdmVersion($expected);
        $actual = $foo->GetEdmVersion();
        $this->assertEquals($expected, $actual);
    }

    public function testSetEdmxVersionRoundTrip()
    {
        $expected = Version::v2();

        $foo = new EdmModel();
        $foo->SetEdmxVersion($expected);
        $actual = $foo->GetEdmxVersion();
        $this->assertEquals($expected, $actual);
    }

    public function testSetDataServiceVersionRoundTrip()
    {
        $expected = Version::v2();

        $foo = new EdmModel();
        $foo->SetDataServiceVersion($expected);
        $actual = $foo->GetDataServiceVersion();
        $this->assertEquals($expected, $actual);
    }

    public function testSetMaxDataServiceVersionRoundTrip()
    {
        $expected = Version::v2();

        $foo = new EdmModel();
        $foo->SetMaxDataServiceVersion($expected);
        $actual = $foo->GetMaxDataServiceVersion();
        $this->assertEquals($expected, $actual);
    }

    public function testSetNamespacePrefixMappings()
    {
        $expected = [];
        $foo      = new EdmModel();
        $actual   = $foo->GetNamespacePrefixMappings();
        $this->assertEquals($expected, $actual);

        $expected = ['foo'];
        $foo->SetNamespacePrefixMappings($expected);
        $actual = $foo->GetNamespacePrefixMappings();
        $this->assertEquals($expected, $actual);
    }

    public function testSetAssociationEndNameRoundTrip()
    {
        $prop = m::mock(INavigationProperty::class);
        $prop->shouldReceive('PopulateCaches')->once();
        $foo = new EdmModel();

        $assoc = 'assoc';

        $foo->SetAssociationEndName($prop, $assoc);

        $expected = 'assoc';
        $actual   = $foo->GetAssociationEndName($prop);
        $this->assertEquals($expected, $actual);
    }

    public function testSetAssociationNameRoundTrip()
    {
        $prop = m::mock(INavigationProperty::class);
        $prop->shouldReceive('PopulateCaches')->once();
        $foo = new EdmModel();

        $assoc = 'assoc';

        $foo->SetAssociationName($prop, $assoc);

        $expected = 'assoc';
        $actual   = $foo->GetAssociationName($prop);
        $this->assertEquals($expected, $actual);
    }

    public function testSetAssociationNamespaceRoundTrip()
    {
        $prop = m::mock(INavigationProperty::class);
        $prop->shouldReceive('PopulateCaches')->once();
        $foo = new EdmModel();

        $assoc = 'assoc';

        $foo->SetAssociationNamespace($prop, $assoc);

        $expected = 'assoc';
        $actual   = $foo->GetAssociationNamespace($prop);
        $this->assertEquals($expected, $actual);
    }

    public function testSetAssociationSetNameRoundTrip()
    {
        $set  = m::mock(IEntitySet::class);
        $prop = m::mock(INavigationProperty::class);
        $prop->shouldReceive('PopulateCaches')->once();
        $foo = new EdmModel();

        $assoc = 'assoc';

        $foo->SetAssociationSetName($set, $prop, $assoc);

        $expected = 'assoc';
        $actual   = $foo->GetAssociationSetName($set, $prop);
        $this->assertEquals($expected, $actual);
    }

    public function testFindAllDerivedTypesNonSchema()
    {
        $baseType = m::mock(IStructuredType::class);

        $foo = new EdmModel();

        $expected = [];
        $actual   = $foo->FindAllDerivedTypes($baseType);
        $this->assertEquals($expected, $actual);
    }

    public function testFindAllDerivedTypesSchemaNothing()
    {
        $baseType = m::mock(IStructuredType::class . ', ' . ISchemaElement::class);

        $foo = new EdmModel();

        $expected = [];
        $actual   = $foo->FindAllDerivedTypes($baseType);
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
        $foo->AddElement($baseType);
        $foo->AddElement($derived);

        $res = $foo->findDirectlyDerivedTypes($baseType);
        $this->assertEquals(0, count($res));

        $expected = [];
        $actual   = $foo->FindAllDerivedTypes($derived);
        $this->assertEquals($expected, $actual);
    }
}
