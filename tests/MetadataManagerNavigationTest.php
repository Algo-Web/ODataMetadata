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

class MetadataManagerNavigationTest extends \PHPUnit_Framework_TestCase
{
    public function testEntitysAndPropertiesAndNavigationPropertiesAndRoleDIRECTION()
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
        $CategoryEType = null;
        $dom = new \DOMDocument();
        $dom->loadXML($d);
        foreach ($dom->getElementsByTagName("EntityType") as $eType) {
            foreach ($eType->attributes as $aType) {
                if ($aType->name == "Name" && $aType->value == "Category") {
                    $CategoryEType = $eType;
                }
            }
        }
        $this->assertNotNull($CategoryEType, "Count not find the category entity Type to get the navigation property");
        $this->assertEquals("Products", $CategoryEType->getElementsByTagName("NavigationProperty")[0]->getAttribute("Name"), "the product relationship was not found");
        $ProductRelationship = $CategoryEType->getElementsByTagName("NavigationProperty")[0]->getAttribute("Relationship");
        $ProductToRole = $CategoryEType->getElementsByTagName("NavigationProperty")[0]->getAttribute("ToRole");
        $ProductFromRole = $CategoryEType->getElementsByTagName("NavigationProperty")[0]->getAttribute("FromRole");
        $associationType = null;
        foreach ($dom->getElementsByTagName("Association") as $eType) {
            foreach ($eType->attributes as $aType) {
                if ($aType->name == "Name" && 'Data.'.$aType->value == $ProductRelationship) {
                    $associationType = $eType;
                }
            }
        }
        $this->assertNotNull($associationType, "count not find a matching assocation for the category");
        foreach ($associationType->getElementsByTagName("End") as $childNode) {
            if ($childNode->getAttribute("Role") == $ProductToRole) {
                $this->assertEquals("Data.Product", $childNode->getAttribute("Type"));
                $this->assertEquals("1", $childNode->getAttribute("Multiplicity"));
            } elseif ($childNode->getAttribute("Role") == $ProductFromRole) {
                $this->assertEquals("Data.Category", $childNode->getAttribute("Type"));
                $this->assertEquals("*", $childNode->getAttribute("Multiplicity"));
            } else {
                throw new \Exception("Some how we ended up with an end role that was not in the NavigationProperty");
            }
        }
    }
}
