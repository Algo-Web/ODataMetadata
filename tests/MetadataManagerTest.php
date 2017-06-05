<?php

namespace AlgoWeb\ODataMetadata\Tests;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataManager;
use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Schema;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReturnTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionType;
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

        $eType = $metadataManager->addEntityType("Category");
        $this->assertNotFalse($eType, "Etype is false not type " . $metadataManager->getLastError());
        $metadataManager->addPropertyToEntityType($eType, "CategoryID", "Int32", null, false, true, "Identity");
        $metadataManager->addPropertyToEntityType($eType, "CategoryName", "String");
        $metadataManager->addPropertyToEntityType($eType, "Description", "String");
        $metadataManager->addPropertyToEntityType($eType, "Picture", "Binary");

        $eType = $metadataManager->addEntityType("CustomerDemographic");
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

        $CategoryType = $metadataManager->addEntityType("Category");
        $this->assertNotFalse($CategoryType, "Etype is false not type " . $metadataManager->getLastError());
        $metadataManager->addPropertyToEntityType($CategoryType, "CategoryID", "Int32", null, false, true, "Identity");
        $metadataManager->addPropertyToEntityType($CategoryType, "CategoryName", "String");
        $metadataManager->addPropertyToEntityType($CategoryType, "Description", "String");
        $metadataManager->addPropertyToEntityType($CategoryType, "Picture", "Binary");
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        $CustomerDemographicType = $metadataManager->addEntityType("CustomerDemographic");
        $metadataManager->addPropertyToEntityType($CustomerDemographicType, "CustomerTypeID", "String", null, false, true);
        $metadataManager->addPropertyToEntityType($CustomerDemographicType, "CustomerDesc", "String");
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        $CustomerType = $metadataManager->addEntityType("Customer");
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

        $EmployeeType = $metadataManager->addEntityType("Employee");
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

        $Order_DetailType = $metadataManager->addEntityType("Order_Detail");
        $metadataManager->addPropertyToEntityType($Order_DetailType, "OrderID", "Int32", null, false, true);
        $metadataManager->addPropertyToEntityType($Order_DetailType, "ProductID", "Int32", null, false, true);
        $metadataManager->addPropertyToEntityType($Order_DetailType, "UnitPrice", "Decimal");
        $metadataManager->addPropertyToEntityType($Order_DetailType, "Quantity", "Int16");
        $metadataManager->addPropertyToEntityType($Order_DetailType, "Discount", "Single");
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        $OrderType = $metadataManager->addEntityType("Order");
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

        $ProductType = $metadataManager->addEntityType("Product");
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


        $metadataManager->addNavigationPropertyToEntityType(
            $CategoryType, "*", "Products", $ProductType, "0..1", "Category", ["CategoryID"], ["CategoryID"]
        );
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
    }
}
