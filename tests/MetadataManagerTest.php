<?php

namespace AlgoWeb\ODataMetadata\Tests;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataManager;
use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Schema;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypePropertyType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReturnTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TNavigationPropertyType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TTextType;
use AlgoWeb\ODataMetadata\MetadataV3\edmx\Edmx;
use Mockery as m;

class MetadataManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testIsOKAtDefault()
    {
        $ds = DIRECTORY_SEPARATOR;
        $metadataManager = new MetadataManager();
        $msg = null;
        $edmx = $metadataManager->getEdmx();
        $this->assertTrue($edmx->isOK($msg), $msg);
        $this->assertNull($msg);

        $d = $metadataManager->getEdmxXML();
        $this->v3MetadataAgainstXSD($d);
    }

    public function v3MetadataAgainstXSD($data)
    {
        $ds = DIRECTORY_SEPARATOR;

        $goodxsd = dirname(__DIR__) . $ds . "xsd" . $ds . "Microsoft.Data.Entity.Design.Edmx_3.Fixed.xsd";
        if (!file_exists($goodxsd)) {
            return true;
        }
        $xml = new \DOMDocument();
        $xml->loadXML($data);
        return $xml->schemaValidate($goodxsd);
    }

    public function testEntitysAndProperties()
    {
        $metadataManager = new MetadataManager();
        $result = null;

        list($eType, $result) = $metadataManager->addEntityType("Category");
        $this->assertNotFalse($eType, "Etype is false not type " . $metadataManager->getLastError());
        $metadataManager->addPropertyToEntityType($eType, "CategoryID", "Int32", null, false, true, "Identity");
        $metadataManager->addPropertyToEntityType($eType, "CategoryName", "String");
        $metadataManager->addPropertyToEntityType($eType, "Description", "String");
        $metadataManager->addPropertyToEntityType($eType, "Picture", "Binary");

        list($eType, $result) = $metadataManager->addEntityType("CustomerDemographic");
        $metadataManager->addPropertyToEntityType($eType, "CustomerTypeID", "String", null, false, true);
        $metadataManager->addPropertyToEntityType($eType, "CustomerDesc", "String");


        $msg = null;
        $edmx = $metadataManager->getEdmx();
        $this->assertTrue($edmx->isOK($msg), $msg);
        $this->assertNull($msg);

        $d = $metadataManager->getEdmxXML();
        $this->v3MetadataAgainstXSD($d);
    }

    public function testEntitysAndPropertiesAndNavigationProperties()
    {
        $msg = null;
        $metadataManager = new MetadataManager();
        $result = null;

        list($CategoryType, $result) = $metadataManager->addEntityType("Category");
        $this->assertNotFalse($CategoryType, "Etype is false not type " . $metadataManager->getLastError());
        $metadataManager->addPropertyToEntityType($CategoryType, "CategoryID", "Int32", null, false, true, "Identity");
        $metadataManager->addPropertyToEntityType($CategoryType, "CategoryName", "String");
        $metadataManager->addPropertyToEntityType($CategoryType, "Description", "String");
        $metadataManager->addPropertyToEntityType($CategoryType, "Picture", "Binary");
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        list($CustomerDemographicType, $result) = $metadataManager->addEntityType("CustomerDemographic");
        $metadataManager->addPropertyToEntityType($CustomerDemographicType, "CustomerTypeID", "String", null, false, true);
        $metadataManager->addPropertyToEntityType($CustomerDemographicType, "CustomerDesc", "String");
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        list($CustomerType, $result) = $metadataManager->addEntityType("Customer");
        $metadataManager->addPropertyToEntityType($CustomerType, "CustomerID", "String", null, false, true);
        $metadataManager->addPropertyToEntityType($CustomerType, "CompanyName", "String");
        $metadataManager->addPropertyToEntityType($CustomerType, "ContactName", "String");
        $metadataManager->addPropertyToEntityType($CustomerType, "ContactTitle", "String");
        $metadataManager->addPropertyToEntityType($CustomerType, "Address", "String");
        $metadataManager->addPropertyToEntityType($CustomerType, "City", "String");
        $metadataManager->addPropertyToEntityType($CustomerType, "Region", "String");
        $metadataManager->addPropertyToEntityType($CustomerType, "PostalCode", "String");
        $metadataManager->addPropertyToEntityType($CustomerType, "Country", "String");
        $metadataManager->addPropertyToEntityType($CustomerType, "Phone", "String");
        $metadataManager->addPropertyToEntityType($CustomerType, "Fax", "String");
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        list($EmployeeType, $result) = $metadataManager->addEntityType("Employee");
        $metadataManager->addPropertyToEntityType($EmployeeType, "EmployeeID", "Int32", null, false, true, "Identity");
        $metadataManager->addPropertyToEntityType($EmployeeType, "LastName", "String");
        $metadataManager->addPropertyToEntityType($EmployeeType, "FirstName", "String");
        $metadataManager->addPropertyToEntityType($EmployeeType, "Title", "String");
        $metadataManager->addPropertyToEntityType($EmployeeType, "TitleOfCourtesy", "String");
        $metadataManager->addPropertyToEntityType($EmployeeType, "BirthDate", "DateTime");
        $metadataManager->addPropertyToEntityType($EmployeeType, "HireDate", "DateTime");
        $metadataManager->addPropertyToEntityType($EmployeeType, "Address", "String");
        $metadataManager->addPropertyToEntityType($EmployeeType, "City", "String");
        $metadataManager->addPropertyToEntityType($EmployeeType, "Region", "String");
        $metadataManager->addPropertyToEntityType($EmployeeType, "PostalCode", "String");
        $metadataManager->addPropertyToEntityType($EmployeeType, "Country", "String");
        $metadataManager->addPropertyToEntityType($EmployeeType, "HomePhone", "String");
        $metadataManager->addPropertyToEntityType($EmployeeType, "Extension", "String");
        $metadataManager->addPropertyToEntityType($EmployeeType, "Photo", "Binary");
        $metadataManager->addPropertyToEntityType($EmployeeType, "Notes", "String");
        $metadataManager->addPropertyToEntityType($EmployeeType, "ReportsTo", "Int32");
        $metadataManager->addPropertyToEntityType($EmployeeType, "PhotoPath", "String");
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        list($Order_DetailType, $result) = $metadataManager->addEntityType("Order_Detail");
        $metadataManager->addPropertyToEntityType($Order_DetailType, "OrderID", "Int32", null, false, true);
        $metadataManager->addPropertyToEntityType($Order_DetailType, "ProductID", "Int32", null, false, true);
        $metadataManager->addPropertyToEntityType($Order_DetailType, "UnitPrice", "Decimal");
        $metadataManager->addPropertyToEntityType($Order_DetailType, "Quantity", "Int16");
        $metadataManager->addPropertyToEntityType($Order_DetailType, "Discount", "Single");
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        list($OrderType, $result) = $metadataManager->addEntityType("Order");
        $metadataManager->addPropertyToEntityType($OrderType, "OrderID", "Int32", null, false, true, "Identity");
        $metadataManager->addPropertyToEntityType($OrderType, "CustomerID", "String");
        $metadataManager->addPropertyToEntityType($OrderType, "EmployeeID", "Int32");
        $metadataManager->addPropertyToEntityType($OrderType, "OrderDate", "DateTime");
        $metadataManager->addPropertyToEntityType($OrderType, "RequiredDate", "DateTime");
        $metadataManager->addPropertyToEntityType($OrderType, "ShippedDate", "DateTime");
        $metadataManager->addPropertyToEntityType($OrderType, "ShipVia", "DateTime");
        $metadataManager->addPropertyToEntityType($OrderType, "Freight", "Decimal");
        $metadataManager->addPropertyToEntityType($OrderType, "ShipName", "String");
        $metadataManager->addPropertyToEntityType($OrderType, "ShipAddress", "String");
        $metadataManager->addPropertyToEntityType($OrderType, "ShipCity", "String");
        $metadataManager->addPropertyToEntityType($OrderType, "ShipRegion", "String");
        $metadataManager->addPropertyToEntityType($OrderType, "ShipPostalCode", "String");
        $metadataManager->addPropertyToEntityType($OrderType, "ShipCountry", "String");
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        list($ProductType, $result) = $metadataManager->addEntityType("Product");
        $metadataManager->addPropertyToEntityType($ProductType, "ProductID", "Int32", null, false, true, "Identity");
        $metadataManager->addPropertyToEntityType($ProductType, "ProductName", "String");
        $metadataManager->addPropertyToEntityType($ProductType, "SupplierID", "Int32");
        $metadataManager->addPropertyToEntityType($ProductType, "CategoryID", "Int32");
        $metadataManager->addPropertyToEntityType($ProductType, "QuantityPerUnit", "String");
        $metadataManager->addPropertyToEntityType($ProductType, "UnitPrice", "Decimal");
        $metadataManager->addPropertyToEntityType($ProductType, "UnitsInStock", "Int16");
        $metadataManager->addPropertyToEntityType($ProductType, "UnitsOnOrder", "Int16");
        $metadataManager->addPropertyToEntityType($ProductType, "ReorderLevel", "Int16");
        $metadataManager->addPropertyToEntityType($ProductType, "Discontinued", "Boolean");
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        $expectedRelation = "Data.Category_Products_Product_Category";
        list($principalNav, ) = $metadataManager->addNavigationPropertyToEntityType(
            $CategoryType, "*", "Products", $ProductType, "1", "Category", ["CategoryID"], ["CategoryID"]
        );
        $this->assertEquals($expectedRelation, $principalNav->getRelationship());
        $metadataManager->addNavigationPropertyToEntityType(
            $Order_DetailType, "1", "Order", $ProductType, "*", "Order_Details", ["OrderID"], ["CategoryID"]
        );
//        <NavigationProperty Name="Order_Details" Relationship="NorthwindModel.FK_Order_Details_Products" ToRole="Order_Details" FromRole="Products"/>


        $msg = null;
        $edmx = $metadataManager->getEdmx();
        $this->assertTrue($edmx->isOK($msg), $msg);
        $this->assertNull($msg);

        $d = $metadataManager->getEdmxXML();
        $this->v3MetadataAgainstXSD($d);
    }

    public function testAddManyToManyNavProperty()
    {
        list($msg, $metadataManager, $CategoryType, $CustomerType) = $this->setUpMetadataForNavTests();

        $expectedRelation = "Data.Category_custom_Customer_categor";
        list($principal, $dependent) = $metadataManager->addNavigationPropertyToEntityType(
            $CategoryType,
            "*",
            "custom",
            $CustomerType,
            "*",
            "categor"
        );
        $this->assertEquals($principal->getFromRole(), $dependent->getToRole());
        $this->assertEquals($dependent->getFromRole(), $principal->getToRole());
        $this->assertEquals("custom", $principal->getName());
        $this->assertEquals("categor", $dependent->getName());
        $this->assertEquals($expectedRelation, $principal->getRelationship());
        $this->assertEquals($expectedRelation, $dependent->getRelationship());

        $navProps = [$principal, $dependent];
        $assoc = $metadataManager->getEdmx()->getDataServiceType()->getSchema()[0]->getAssociation();
        $this->assertEquals(1, count($assoc));
        $assoc = $assoc[0];
        $this->assertTrue($assoc instanceof TAssociationType);
        $this->assertTrue($assoc->isOK($msg), $msg);

        $this->assertEquals('Data.'.$assoc->getName(), $principal->getRelationship());
        $ends = $assoc->getEnd();

        $this->assertEquals(2, count($ends));
        $this->checkNavProps($navProps, $ends);
        list($principalEnd, $dependentEnd) = $this->figureOutEnds($ends, $principal, $dependent);
        $this->assertEquals('*', $principalEnd->getMultiplicity());
        $this->assertEquals('*', $dependentEnd->getMultiplicity());
    }

    public function testAddOneToManyNavProperty()
    {
        list($msg, $metadataManager, $CategoryType, $CustomerType) = $this->setUpMetadataForNavTests();

        list($principal, $dependent) = $metadataManager->addNavigationPropertyToEntityType(
            $CategoryType,
            "*",
            "custom",
            $CustomerType,
            "1",
            "categor"
        );
        $this->assertEquals($principal->getFromRole(), $dependent->getToRole());
        $this->assertEquals($dependent->getFromRole(), $principal->getToRole());
        $this->assertEquals("custom", $principal->getName());
        $this->assertEquals("categor", $dependent->getName());

        $navProps = [$principal, $dependent];
        $assoc = $metadataManager->getEdmx()->getDataServiceType()->getSchema()[0]->getAssociation();
        $this->assertEquals(1, count($assoc));
        $assoc = $assoc[0];
        $this->assertTrue($assoc instanceof TAssociationType);
        $this->assertTrue($assoc->isOK($msg), $msg);

        $this->assertEquals('Data.'.$assoc->getName(), $principal->getRelationship());
        $ends = $assoc->getEnd();

        $this->assertEquals(2, count($ends));
        $this->checkNavProps($navProps, $ends);
        list($principalEnd, $dependentEnd) = $this->figureOutEnds($ends, $principal, $dependent);
        $this->assertEquals('*', $principalEnd->getMultiplicity());
        $this->assertEquals('1', $dependentEnd->getMultiplicity());
    }

    public function testAddManyToOneNavProperty()
    {
        list($msg, $metadataManager, $CategoryType, $CustomerType) = $this->setUpMetadataForNavTests();

        list($principal, $dependent) = $metadataManager->addNavigationPropertyToEntityType(
            $CategoryType,
            "1",
            "custom",
            $CustomerType,
            "*",
            "categor"
        );
        $this->assertEquals($principal->getFromRole(), $dependent->getToRole());
        $this->assertEquals($dependent->getFromRole(), $principal->getToRole());
        $this->assertEquals("custom", $principal->getName());
        $this->assertEquals("categor", $dependent->getName());

        $navProps = [$principal, $dependent];
        $assoc = $metadataManager->getEdmx()->getDataServiceType()->getSchema()[0]->getAssociation();
        $this->assertEquals(1, count($assoc));
        $assoc = $assoc[0];
        $this->assertTrue($assoc instanceof TAssociationType);
        $this->assertTrue($assoc->isOK($msg), $msg);

        $this->assertEquals('Data.'.$assoc->getName(), $principal->getRelationship());
        $ends = $assoc->getEnd();

        $this->assertEquals(2, count($ends));
        $this->checkNavProps($navProps, $ends);
        list($principalEnd, $dependentEnd) = $this->figureOutEnds($ends, $principal, $dependent);
        $this->assertEquals('1', $principalEnd->getMultiplicity());
        $this->assertEquals('*', $dependentEnd->getMultiplicity());
    }

    public function testAddOneToOneForwardNavProperty()
    {
        list($msg, $metadataManager, $CategoryType, $CustomerType) = $this->setUpMetadataForNavTests();

        list($principal, $dependent) = $metadataManager->addNavigationPropertyToEntityType(
            $CategoryType,
            "0..1",
            "custom",
            $CustomerType,
            "1",
            "categor"
        );
        $this->assertEquals($principal->getFromRole(), $dependent->getToRole());
        $this->assertEquals($dependent->getFromRole(), $principal->getToRole());
        $this->assertEquals("custom", $principal->getName());
        $this->assertEquals("categor", $dependent->getName());

        $navProps = [$principal, $dependent];
        $assoc = $metadataManager->getEdmx()->getDataServiceType()->getSchema()[0]->getAssociation();
        $this->assertEquals(1, count($assoc));
        $assoc = $assoc[0];
        $this->assertTrue($assoc instanceof TAssociationType);
        $this->assertTrue($assoc->isOK($msg), $msg);

        $this->assertEquals('Data.'.$assoc->getName(), $principal->getRelationship());
        $ends = $assoc->getEnd();

        $this->assertEquals(2, count($ends));
        $this->checkNavProps($navProps, $ends);
        list($principalEnd, $dependentEnd) = $this->figureOutEnds($ends, $principal, $dependent);
        $this->assertEquals('0..1', $principalEnd->getMultiplicity());
        $this->assertEquals('1', $dependentEnd->getMultiplicity());
    }

    public function testAddOneToOneReverseNavProperty()
    {
        list($msg, $metadataManager, $CategoryType, $CustomerType) = $this->setUpMetadataForNavTests();

        list($principal, $dependent) = $metadataManager->addNavigationPropertyToEntityType(
            $CategoryType,
            "1",
            "custom",
            $CustomerType,
            "0..1",
            "categor"
        );
        $this->assertEquals($principal->getFromRole(), $dependent->getToRole());
        $this->assertEquals($dependent->getFromRole(), $principal->getToRole());
        $this->assertEquals("custom", $principal->getName());
        $this->assertEquals("categor", $dependent->getName());

        $navProps = [$principal, $dependent];
        $assoc = $metadataManager->getEdmx()->getDataServiceType()->getSchema()[0]->getAssociation();
        $this->assertEquals(1, count($assoc));
        $assoc = $assoc[0];
        $this->assertTrue($assoc instanceof TAssociationType);
        $this->assertTrue($assoc->isOK($msg), $msg);

        $this->assertEquals('Data.'.$assoc->getName(), $principal->getRelationship());
        $ends = $assoc->getEnd();

        $this->assertEquals(2, count($ends));
        $this->checkNavProps($navProps, $ends);
        list($principalEnd, $dependentEnd) = $this->figureOutEnds($ends, $principal, $dependent);
        $this->assertEquals('1', $principalEnd->getMultiplicity());
        $this->assertEquals('0..1', $dependentEnd->getMultiplicity());
    }

    public function testMetadataSerialiseRoundTrip()
    {
        $bar = new MetadataManager();
        $foo = new MetadataManager();

        $cereal = serialize($foo);

        $foo = unserialize($cereal);
        $this->assertTrue(null != $foo->getSerialiser());
        $this->assertEquals($bar, $foo);
    }

    public function testCreateSingletonBadReturnType()
    {
        $returnType = m::mock(IsOK::class);
        $foo = new MetadataManager();

        $expected = "Expected return type must be either TEntityType or TComplexType";
        $actual = null;

        try {
            $foo->createSingleton(null, $returnType);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testCreateSingletonEmptyName()
    {
        $returnType = m::mock(TEntityTypeType::class);
        $this->assertTrue($returnType instanceof TEntityTypeType, get_class($returnType));
        $foo = new MetadataManager();

        $expected = "Name must be a non-empty string";
        $actual = null;

        try {
            $foo->createSingleton(null, $returnType);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testCreateSingletonNonStringName()
    {
        $returnType = m::mock(TEntityTypeType::class);
        $this->assertTrue($returnType instanceof TEntityTypeType, get_class($returnType));
        $foo = new MetadataManager();

        $expected = "Name must be a non-empty string";
        $actual = null;

        try {
            $foo->createSingleton($returnType, $returnType);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testCreateSingletonSuccessful()
    {
        $msg = null;
        $name = "singleton";
        $returnType = m::mock(TEntityTypeType::class)->makePartial();
        $returnType->shouldReceive('getName')->andReturn('doubleton');

        $entityContainer = m::mock(EntityContainer::class)->makePartial();
        $entityContainer->shouldReceive('addToFunctionImport')->andReturn(null)->once();

        $schema = m::mock(Schema::class)->makePartial();
        $schema->shouldReceive('getEntityContainer')->andReturn([$entityContainer])->once();
        $edmx = m::mock(Edmx::class)->makePartial();
        $edmx->shouldReceive('getDataServiceType->getSchema')->andReturn([$schema])->once();

        $foo = m::mock(MetadataManager::class)->makePartial();
        $foo->shouldReceive('getEdmx')->andReturn($edmx);

        $result = $foo->createSingleton($name, $returnType);
        $this->assertTrue($result instanceof EntityContainer\FunctionImportAnonymousType, get_class($result));
        $this->assertTrue($result->isOK($msg));
        $this->assertNull($result->getDocumentation());
    }

    public function testCreateSingletonWithDocumentation()
    {
        $msg = null;
        $name = "singleton";
        $shortDesc = new TTextType();
        $longDesc = new TTextType();

        $returnType = m::mock(TEntityTypeType::class)->makePartial();
        $returnType->shouldReceive('getName')->andReturn('doubleton');

        $entityContainer = m::mock(EntityContainer::class)->makePartial();
        $entityContainer->shouldReceive('addToFunctionImport')->andReturn(null)->once();

        $schema = m::mock(Schema::class)->makePartial();
        $schema->shouldReceive('getEntityContainer')->andReturn([$entityContainer])->once();
        $edmx = m::mock(Edmx::class)->makePartial();
        $edmx->shouldReceive('getDataServiceType->getSchema')->andReturn([$schema])->once();

        $foo = m::mock(MetadataManager::class)->makePartial();
        $foo->shouldReceive('getEdmx')->andReturn($edmx);

        $result = $foo->createSingleton($name, $returnType, $shortDesc, $longDesc);
        $this->assertTrue($result instanceof EntityContainer\FunctionImportAnonymousType, get_class($result));
        $this->assertTrue($result->isOK($msg));
        $this->assertNotNull($result->getDocumentation());
    }

    public function testCreateSingletonWithDocumentationOnlyShortDesc()
    {
        $msg = null;
        $name = "singleton";
        $shortDesc = new TTextType();
        $longDesc = null;

        $returnType = m::mock(TEntityTypeType::class)->makePartial();
        $returnType->shouldReceive('getName')->andReturn('doubleton');

        $entityContainer = m::mock(EntityContainer::class)->makePartial();
        $entityContainer->shouldReceive('addToFunctionImport')->andReturn(null)->once();

        $schema = m::mock(Schema::class)->makePartial();
        $schema->shouldReceive('getEntityContainer')->andReturn([$entityContainer])->once();
        $edmx = m::mock(Edmx::class)->makePartial();
        $edmx->shouldReceive('getDataServiceType->getSchema')->andReturn([$schema])->once();

        $foo = m::mock(MetadataManager::class)->makePartial();
        $foo->shouldReceive('getEdmx')->andReturn($edmx);

        $result = $foo->createSingleton($name, $returnType, $shortDesc, $longDesc);
        $this->assertTrue($result instanceof EntityContainer\FunctionImportAnonymousType, get_class($result));
        $this->assertTrue($result->isOK($msg));
        $this->assertNull($result->getDocumentation());
    }

    public function testCreateSingletonWithDocumentationOnlyLongDesc()
    {
        $msg = null;
        $name = "singleton";
        $shortDesc = null;
        $longDesc = new TTextType();

        $returnType = m::mock(TEntityTypeType::class)->makePartial();
        $returnType->shouldReceive('getName')->andReturn('doubleton');

        $entityContainer = m::mock(EntityContainer::class)->makePartial();
        $entityContainer->shouldReceive('addToFunctionImport')->andReturn(null)->once();

        $schema = m::mock(Schema::class)->makePartial();
        $schema->shouldReceive('getEntityContainer')->andReturn([$entityContainer])->once();
        $edmx = m::mock(Edmx::class)->makePartial();
        $edmx->shouldReceive('getDataServiceType->getSchema')->andReturn([$schema])->once();

        $foo = m::mock(MetadataManager::class)->makePartial();
        $foo->shouldReceive('getEdmx')->andReturn($edmx);

        $result = $foo->createSingleton($name, $returnType, $shortDesc, $longDesc);
        $this->assertTrue($result instanceof EntityContainer\FunctionImportAnonymousType, get_class($result));
        $this->assertTrue($result->isOK($msg));
        $this->assertNull($result->getDocumentation());
    }

    public function testMalformedMultiplicity()
    {
        list(, $metadataManager, $CategoryType, $CustomerType) = $this->setUpMetadataForNavTests();

        $expected = "Malformed multiplicity - valid values are *, 0..1 and 1";
        $actual = null;

        try {
            $metadataManager->addNavigationPropertyToEntityType(
                $CategoryType,
                "1",
                "Customers",
                $CustomerType,
                "ABC",
                "Categories"
            );
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testInvalidMultiplicityBelongsOnBothEnds()
    {
        list(, $metadataManager, $CategoryType, $CustomerType) = $this->setUpMetadataForNavTests();

        $expected =  "Invalid multiplicity combination - 1 1";
        $actual = null;

        try {
            $metadataManager->addNavigationPropertyToEntityType(
                $CategoryType,
                "1",
                "Customers",
                $CustomerType,
                "1",
                "Categories"
            );
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testInvalidMultiplicityManyToHasMany()
    {
        list(, $metadataManager, $CategoryType, $CustomerType) = $this->setUpMetadataForNavTests();

        $expected =  "Invalid multiplicity combination - * 0..1";
        $actual = null;

        try {
            $metadataManager->addNavigationPropertyToEntityType(
                $CategoryType,
                "*",
                "Customers",
                $CustomerType,
                "0..1",
                "Categories"
            );
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testAddComplexType()
    {
        list(, $metadataManager, , ) = $this->setUpMetadataForNavTests();

        $name = "Name";
        $accessType = "Public";
        $summary = new TTextType();
        $longDescription = new TTextType();

        $oldCount = count($metadataManager->getEdmx()->getDataServiceType()->getSchema()[0]->getComplexType());

        $result = $metadataManager->addComplexType($name, $accessType, $summary, $longDescription);

        $newCount = count($metadataManager->getEdmx()->getDataServiceType()->getSchema()[0]->getComplexType());
        $this->assertEquals($oldCount+1, $newCount);
        $this->assertNotNull($result);
        $this->assertTrue($result instanceof TComplexTypeType, get_class($result));
        $this->assertNotNull($result->getDocumentation());
    }

    public function testAddComplexTypeWithOnlySummary()
    {
        list(, $metadataManager, , ) = $this->setUpMetadataForNavTests();

        $name = "Name";
        $accessType = "Public";
        $summary = new TTextType();
        $longDescription = null;

        $oldCount = count($metadataManager->getEdmx()->getDataServiceType()->getSchema()[0]->getComplexType());

        $result = $metadataManager->addComplexType($name, $accessType, $summary, $longDescription);

        $newCount = count($metadataManager->getEdmx()->getDataServiceType()->getSchema()[0]->getComplexType());
        $this->assertEquals($oldCount+1, $newCount);
        $this->assertNotNull($result);
        $this->assertTrue($result instanceof TComplexTypeType, get_class($result));
        $this->assertNull($result->getDocumentation());
    }

    public function testAddComplexTypeWithOnlyDescription()
    {
        list(, $metadataManager, , ) = $this->setUpMetadataForNavTests();

        $name = "Name";
        $accessType = "Public";
        $summary = null;
        $longDescription = new TTextType();

        $oldCount = count($metadataManager->getEdmx()->getDataServiceType()->getSchema()[0]->getComplexType());

        $result = $metadataManager->addComplexType($name, $accessType, $summary, $longDescription);

        $newCount = count($metadataManager->getEdmx()->getDataServiceType()->getSchema()[0]->getComplexType());
        $this->assertEquals($oldCount+1, $newCount);
        $this->assertNotNull($result);
        $this->assertTrue($result instanceof TComplexTypeType, get_class($result));
        $this->assertNull($result->getDocumentation());
    }

    public function testAddPropertyToComplexTypeDefaultValueArray()
    {
        $expected = "Default value cannot be object or array";
        $actual = null;

        list(, $metadataManager, , ) = $this->setUpMetadataForNavTests();
        $complex = m::mock(TComplexTypeType::class);
        $name = "name";
        $type = "type";
        $defaultValue = [];

        try {
            $metadataManager->addPropertyToComplexType($complex, $name, $type, $defaultValue);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testAddPropertyToComplexTypeDefaultValueObject()
    {
        $expected = "Default value cannot be object or array";
        $actual = null;

        list(, $metadataManager, , ) = $this->setUpMetadataForNavTests();
        $complex = m::mock(TComplexTypeType::class);
        $name = "name";
        $type = "type";
        $defaultValue = new \stdClass();

        try {
            $metadataManager->addPropertyToComplexType($complex, $name, $type, $defaultValue);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testAddPropertyToComplexTypeDefaultValueBoolean()
    {
        list(, $metadataManager, , ) = $this->setUpMetadataForNavTests();
        $complex = m::mock(TComplexTypeType::class);
        $complex->shouldReceive('addToProperty')
            ->with(m::type(TComplexTypePropertyType::class))->andReturnNull()->once();
        $name = "name";
        $type = "type";
        $defaultValue = true;
        $summary = new TTextType();
        $longDescription = new TTextType();
        $expectedDefault = 'true';

        $result = $metadataManager->addPropertyToComplexType(
            $complex,
            $name,
            $type,
            $defaultValue,
            false,
            $summary,
            $longDescription
        );
        $this->assertEquals(1, count($result->getDocumentation()));
        $this->assertEquals($expectedDefault, $result->getDefaultValue());
    }

    public function testAddPropertyToComplexTypeDefaultValueBooleanOnlySummary()
    {
        list(, $metadataManager, , ) = $this->setUpMetadataForNavTests();
        $complex = m::mock(TComplexTypeType::class);
        $complex->shouldReceive('addToProperty')
            ->with(m::type(TComplexTypePropertyType::class))->andReturnNull()->once();
        $name = "name";
        $type = "type";
        $defaultValue = true;
        $summary = new TTextType();
        $longDescription = null;
        $expectedDefault = 'true';

        $result = $metadataManager->addPropertyToComplexType(
            $complex,
            $name,
            $type,
            $defaultValue,
            false,
            $summary,
            $longDescription
        );
        $this->assertNotNull($result);
        $this->assertEquals(0, count($result->getDocumentation()));
        $this->assertEquals($expectedDefault, $result->getDefaultValue());
    }

    public function testAddPropertyToComplexTypeDefaultValueBooleanOnlyDescription()
    {
        list(, $metadataManager, , ) = $this->setUpMetadataForNavTests();
        $complex = m::mock(TComplexTypeType::class);
        $complex->shouldReceive('addToProperty')
            ->with(m::type(TComplexTypePropertyType::class))->andReturnNull()->once();
        $name = "name";
        $type = "type";
        $defaultValue = true;
        $summary = null;
        $longDescription = new TTextType();
        $expectedDefault = 'true';

        $result = $metadataManager->addPropertyToComplexType(
            $complex,
            $name,
            $type,
            $defaultValue,
            false,
            $summary,
            $longDescription
        );
        $this->assertEquals(0, count($result->getDocumentation()));
        $this->assertEquals($expectedDefault, $result->getDefaultValue());
    }

    public function testAddPropertyToEntityType()
    {
        $metadataManager = new MetadataManager();
        $entity = m::mock(TEntityTypeType::class);
        $entity->shouldReceive('addToProperty')
            ->with(m::type(TEntityPropertyType::class))->andReturnNull()->once();
        $name = "name";
        $type = "type";
        $summary = new TTextType();
        $defaultValue = "true";
        $longDescription = new TTextType();

        $result = $metadataManager->addPropertyToEntityType(
            $entity,
            $name,
            $type,
            $defaultValue,
            false,
            false,
            null,
            $summary,
            $longDescription
        );
        $this->assertNotNull($result);
        $this->assertTrue(is_array($result->getDocumentation()));
        $this->assertEquals(1, count($result->getDocumentation()));
        $this->assertEquals("true", $result->getDefaultValue());
    }

    public function testAddPropertyToEntityTypeOnlySummary()
    {
        $metadataManager = new MetadataManager();
        $entity = m::mock(TEntityTypeType::class);
        $entity->shouldReceive('addToProperty')
            ->with(m::type(TEntityPropertyType::class))->andReturnNull()->once();
        $name = "name";
        $type = "type";
        $summary = new TTextType();
        $defaultValue = "true";
        $longDescription = null;

        $result = $metadataManager->addPropertyToEntityType(
            $entity,
            $name,
            $type,
            $defaultValue,
            false,
            false,
            null,
            $summary,
            $longDescription
        );
        $this->assertNotNull($result);
        $this->assertTrue(is_array($result->getDocumentation()));
        $this->assertEquals(0, count($result->getDocumentation()));
        $this->assertEquals("true", $result->getDefaultValue());
    }

    public function testAddPropertyToEntityTypeOnlyDescription()
    {
        $metadataManager = new MetadataManager();
        $entity = m::mock(TEntityTypeType::class);
        $entity->shouldReceive('addToProperty')
            ->with(m::type(TEntityPropertyType::class))->andReturnNull()->once();
        $name = "name";
        $type = "type";
        $summary = null;
        $defaultValue = "true";
        $longDescription = new TTextType();

        $result = $metadataManager->addPropertyToEntityType(
            $entity,
            $name,
            $type,
            $defaultValue,
            false,
            false,
            null,
            $summary,
            $longDescription
        );
        $this->assertNotNull($result);
        $this->assertTrue(is_array($result->getDocumentation()));
        $this->assertEquals(0, count($result->getDocumentation()));
        $this->assertEquals("true", $result->getDefaultValue());
    }

    public function testAddEntityTypeWithDocumentation()
    {
        $name = "name";
        $accessType = "Public";
        $summary = new TTextType();
        $longDescription = new TTextType();

        $metadataManager = new MetadataManager();
        list($result, ) = $metadataManager->addEntityType($name, $accessType, $summary, $longDescription);
        $this->assertNotNull($result->getDocumentation());
    }

    public function testAddEntityTypeWithDocumentationFromOnlySummary()
    {
        $name = "name";
        $accessType = "Public";
        $summary = new TTextType();
        $longDescription = null;

        $metadataManager = new MetadataManager();
        list($result, ) = $metadataManager->addEntityType($name, $accessType, $summary, $longDescription);
        $this->assertNull($result->getDocumentation());
    }

    public function testAddEntityTypeWithDocumentationFromOnlyDocumentation()
    {
        $name = "name";
        $accessType = "Public";
        $summary = null;
        $longDescription = new TTextType();

        $metadataManager = new MetadataManager();
        list($result, ) = $metadataManager->addEntityType($name, $accessType, $summary, $longDescription);
        $this->assertNull($result->getDocumentation());
    }

    public function testAddNavigationPropertyToEntityTypeWithDocumentation()
    {
        list(, $metadataManager, $CategoryType, $CustomerType) = $this->setUpMetadataForNavTests();

        $summary = new TTextType();
        $longDescription = new TTextType();
        $mult = '*';
        $principalProperty = 'Categories';
        $dependentProperty = 'Customers';

        list($principal, $dependent) = $metadataManager
            ->addNavigationPropertyToEntityType(
                $CategoryType,
                $mult,
                $principalProperty,
                $CustomerType,
                $mult,
                $dependentProperty,
                null,
                null,
                "Public",
                "Public",
                "Public",
                "Public",
                $summary,
                $longDescription,
                $summary,
                $longDescription
            );

        $this->assertNotNull($principal->getDocumentation());
        $this->assertNotNull($dependent->getDocumentation());
    }

    public function testAddNavigationPropertyToEntityTypeWithDocumentationWithOnlySummary()
    {
        list(, $metadataManager, $CategoryType, $CustomerType) = $this->setUpMetadataForNavTests();

        $summary = null;
        $longDescription = new TTextType();
        $mult = '*';
        $principalProperty = 'Categories';
        $dependentProperty = 'Customers';

        list($principal, $dependent) = $metadataManager
            ->addNavigationPropertyToEntityType(
                $CategoryType,
                $mult,
                $principalProperty,
                $CustomerType,
                $mult,
                $dependentProperty,
                null,
                null,
                "Public",
                "Public",
                "Public",
                "Public",
                $summary,
                $longDescription,
                $summary,
                $longDescription
            );

        $this->assertNull($principal->getDocumentation());
        $this->assertNull($dependent->getDocumentation());
    }

    public function testAddNavigationPropertyToEntityTypeWithDocumentationWithOnlyDescription()
    {
        list(, $metadataManager, $CategoryType, $CustomerType) = $this->setUpMetadataForNavTests();

        $summary = new TTextType();
        $longDescription = null;
        $mult = '*';
        $principalProperty = 'Categories';
        $dependentProperty = 'Customers';

        list($principal, $dependent) = $metadataManager
            ->addNavigationPropertyToEntityType(
                $CategoryType,
                $mult,
                $principalProperty,
                $CustomerType,
                $mult,
                $dependentProperty,
                null,
                null,
                "Public",
                "Public",
                "Public",
                "Public",
                $summary,
                $longDescription,
                $summary,
                $longDescription
            );

        $this->assertNull($principal->getDocumentation());
        $this->assertNull($dependent->getDocumentation());
    }

    public function testCreateAssociationFromNavigationPropertyRelationMismatch()
    {
        $principalType = m::mock(TEntityTypeType::class);
        $dependentType = m::mock(TEntityTypeType::class);
        $principalNav = m::mock(TNavigationPropertyType::class);
        $principalNav->shouldReceive('getRelationship')->andReturn('foo')->once();
        $dependentNav = m::mock(TNavigationPropertyType::class);
        $dependentNav->shouldReceive('getRelationship')->andReturn('bar')->once();

        $metadataManager = new MetadataManagerDummy();

        $expected = "If you have both a dependent property and a principal property, relationship should match";
        $actual = null;

        try {
            $metadataManager->createAssocationFromNavigationProperty(
                $principalType,
                $dependentType,
                $principalNav,
                $dependentNav,
                "*",
                "*"
            );
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testCreateAssociationFromNavigationPropertyForwardRoleMismatch()
    {
        $principalType = m::mock(TEntityTypeType::class);
        $dependentType = m::mock(TEntityTypeType::class);
        $principalNav = m::mock(TNavigationPropertyType::class);
        $principalNav->shouldReceive('getRelationship')->andReturn('foo')->once();
        $principalNav->shouldReceive('getToRole')->andReturn('Forwards');
        $principalNav->shouldReceive('getFromRole')->andReturn('Reverse');
        $dependentNav = m::mock(TNavigationPropertyType::class);
        $dependentNav->shouldReceive('getRelationship')->andReturn('foo')->once();
        $dependentNav->shouldReceive('getToRole')->andReturn('Reverse');
        $dependentNav->shouldReceive('getFromRole')->andReturn('Sideways');

        $metadataManager = new MetadataManagerDummy();

        $expected = "Principal to role should match dependent from role, and vice versa";
        $actual = null;

        try {
            $metadataManager->createAssocationFromNavigationProperty(
                $principalType,
                $dependentType,
                $principalNav,
                $dependentNav,
                "*",
                "*"
            );
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testCreateAssociationFromNavigationPropertyReverseRoleMismatch()
    {
        $principalType = m::mock(TEntityTypeType::class);
        $dependentType = m::mock(TEntityTypeType::class);
        $principalNav = m::mock(TNavigationPropertyType::class);
        $principalNav->shouldReceive('getRelationship')->andReturn('foo')->once();
        $principalNav->shouldReceive('getToRole')->andReturn('Forwards');
        $principalNav->shouldReceive('getFromRole')->andReturn('Reverse');
        $dependentNav = m::mock(TNavigationPropertyType::class);
        $dependentNav->shouldReceive('getRelationship')->andReturn('foo')->once();
        $dependentNav->shouldReceive('getToRole')->andReturn('Sideways');
        $dependentNav->shouldReceive('getFromRole')->andReturn('Forwards');

        $metadataManager = new MetadataManagerDummy();

        $expected = "Principal to role should match dependent from role, and vice versa";
        $actual = null;

        try {
            $metadataManager->createAssocationFromNavigationProperty(
                $principalType,
                $dependentType,
                $principalNav,
                $dependentNav,
                "*",
                "*"
            );
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    private function setUpMetadataForNavTests()
    {
        $msg = null;
        $metadataManager = new MetadataManager("Data", "Container");
        $expectedCategorySetName = 'Categories';
        $expectedCustomerSetName = 'Customers';

        list($CategoryType, $CategorySet) = $metadataManager->addEntityType("Category");
        list($CustomerType, $CustomerSet) = $metadataManager->addEntityType("Customer");
        $this->assertTrue($CategoryType->isOK($msg), $msg);
        $this->assertTrue($CustomerType->isOK($msg), $msg);
        $this->assertEquals($expectedCategorySetName, $CategorySet->getName());
        $this->assertEquals($expectedCustomerSetName, $CustomerSet->getName());
        return [$msg, $metadataManager, $CategoryType, $CustomerType];
    }

    /**
     * @param $navProps
     * @param $ends
     */
    private function checkNavProps($navProps, $ends)
    {
        foreach ($navProps as $prop) {
            $propToRole = $prop->getToRole();
            $propFromRole = $prop->getFromRole();
            $fromMatch = $ends[0]->getRole() == $propToRole
                         || $ends[1]->getRole() == $propToRole;
            $this->assertTrue($fromMatch, "toRole must match at least one end role");
            if ($ends[0]->getRole() == $propToRole) {
                $this->assertEquals($ends[1]->getRole(), $propFromRole);
                $this->assertNotEquals($ends[0]->getRole(), $propFromRole);
            } else {
                $this->assertEquals($ends[0]->getRole(), $propFromRole);
                $this->assertNotEquals($ends[1]->getRole(), $propFromRole);
            }
        }
    }

    /**
     * @param $ends
     * @param $principal
     * @param $dependent
     * @return array
     */
    private function figureOutEnds($ends, $principal, $dependent)
    {
        // if role is from Products, then type must be from Products - ie, use getFromRole
        $principalEnd = ($ends[0]->getRole() == $principal->getFromRole()) ? $ends[0] : $ends[1];
        $dependentEnd = ($ends[0]->getRole() == $dependent->getFromRole()) ? $ends[0] : $ends[1];
        return [$principalEnd, $dependentEnd];
    }
}
