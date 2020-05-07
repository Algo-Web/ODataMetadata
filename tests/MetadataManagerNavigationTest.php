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

class MetadataManagerNavigationTest extends \PHPUnit\Framework\TestCase
{
    public function testEntitysAndPropertiesAndNavigationPropertiesAndRoleDIRECTION()
    {
        $msg = null;
        $metadataManager = new MetadataManager();
        $result = null;

        list($categoryType, $result) = $metadataManager->addEntityType('Category');
        $this->assertNotFalse($categoryType, 'Etype is false not type ' . $metadataManager->getLastError());
        assert($categoryType instanceof TEntityTypeType, get_class($categoryType));
        $metadataManager->addPropertyToEntityType($categoryType, 'CategoryID', 'Int32', null, false, true, 'Identity');
        $metadataManager->addPropertyToEntityType($categoryType, 'CategoryName', 'String');
        $metadataManager->addPropertyToEntityType($categoryType, 'Description', 'String');
        $metadataManager->addPropertyToEntityType($categoryType, 'Picture', 'Binary');
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        list($customerDemographicType, $result) = $metadataManager->addEntityType('CustomerDemographic');
        assert($customerDemographicType instanceof TEntityTypeType, get_class($customerDemographicType));
        $metadataManager->addPropertyToEntityType($customerDemographicType, 'CustomerTypeID', 'String', null, false, true);
        $metadataManager->addPropertyToEntityType($customerDemographicType, 'CustomerDesc', 'String');
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        list($customerType, $result) = $metadataManager->addEntityType('Customer');
        assert($customerType instanceof TEntityTypeType, get_class($customerType));
        $metadataManager->addPropertyToEntityType($customerType, 'CustomerID', 'String', null, false, true);
        $metadataManager->addPropertyToEntityType($customerType, 'CompanyName', 'String');
        $metadataManager->addPropertyToEntityType($customerType, 'ContactName', 'String');
        $metadataManager->addPropertyToEntityType($customerType, 'ContactTitle', 'String');
        $metadataManager->addPropertyToEntityType($customerType, 'Address', 'String');
        $metadataManager->addPropertyToEntityType($customerType, 'City', 'String');
        $metadataManager->addPropertyToEntityType($customerType, 'Region', 'String');
        $metadataManager->addPropertyToEntityType($customerType, 'PostalCode', 'String');
        $metadataManager->addPropertyToEntityType($customerType, 'Country', 'String');
        $metadataManager->addPropertyToEntityType($customerType, 'Phone', 'String');
        $metadataManager->addPropertyToEntityType($customerType, 'Fax', 'String');
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        list($employeeType, $result) = $metadataManager->addEntityType('Employee');
        assert($employeeType instanceof TEntityTypeType, get_class($employeeType));
        $metadataManager->addPropertyToEntityType($employeeType, 'EmployeeID', 'Int32', null, false, true, 'Identity');
        $metadataManager->addPropertyToEntityType($employeeType, 'LastName', 'String');
        $metadataManager->addPropertyToEntityType($employeeType, 'FirstName', 'String');
        $metadataManager->addPropertyToEntityType($employeeType, 'Title', 'String');
        $metadataManager->addPropertyToEntityType($employeeType, 'TitleOfCourtesy', 'String');
        $metadataManager->addPropertyToEntityType($employeeType, 'BirthDate', 'DateTime');
        $metadataManager->addPropertyToEntityType($employeeType, 'HireDate', 'DateTime');
        $metadataManager->addPropertyToEntityType($employeeType, 'Address', 'String');
        $metadataManager->addPropertyToEntityType($employeeType, 'City', 'String');
        $metadataManager->addPropertyToEntityType($employeeType, 'Region', 'String');
        $metadataManager->addPropertyToEntityType($employeeType, 'PostalCode', 'String');
        $metadataManager->addPropertyToEntityType($employeeType, 'Country', 'String');
        $metadataManager->addPropertyToEntityType($employeeType, 'HomePhone', 'String');
        $metadataManager->addPropertyToEntityType($employeeType, 'Extension', 'String');
        $metadataManager->addPropertyToEntityType($employeeType, 'Photo', 'Binary');
        $metadataManager->addPropertyToEntityType($employeeType, 'Notes', 'String');
        $metadataManager->addPropertyToEntityType($employeeType, 'ReportsTo', 'Int32');
        $metadataManager->addPropertyToEntityType($employeeType, 'PhotoPath', 'String');
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        list($orderDetailType, $result) = $metadataManager->addEntityType('Order_Detail');
        assert($orderDetailType instanceof TEntityTypeType, get_class($orderDetailType));
        $metadataManager->addPropertyToEntityType($orderDetailType, 'OrderID', 'Int32', null, false, true);
        $metadataManager->addPropertyToEntityType($orderDetailType, 'ProductID', 'Int32', null, false, true);
        $metadataManager->addPropertyToEntityType($orderDetailType, 'UnitPrice', 'Decimal');
        $metadataManager->addPropertyToEntityType($orderDetailType, 'Quantity', 'Int16');
        $metadataManager->addPropertyToEntityType($orderDetailType, 'Discount', 'Single');
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        list($orderType, $result) = $metadataManager->addEntityType('Order');
        assert($orderType instanceof TEntityTypeType, get_class($orderType));
        $metadataManager->addPropertyToEntityType($orderType, 'OrderID', 'Int32', null, false, true, 'Identity');
        $metadataManager->addPropertyToEntityType($orderType, 'CustomerID', 'String');
        $metadataManager->addPropertyToEntityType($orderType, 'EmployeeID', 'Int32');
        $metadataManager->addPropertyToEntityType($orderType, 'OrderDate', 'DateTime');
        $metadataManager->addPropertyToEntityType($orderType, 'RequiredDate', 'DateTime');
        $metadataManager->addPropertyToEntityType($orderType, 'ShippedDate', 'DateTime');
        $metadataManager->addPropertyToEntityType($orderType, 'ShipVia', 'DateTime');
        $metadataManager->addPropertyToEntityType($orderType, 'Freight', 'Decimal');
        $metadataManager->addPropertyToEntityType($orderType, 'ShipName', 'String');
        $metadataManager->addPropertyToEntityType($orderType, 'ShipAddress', 'String');
        $metadataManager->addPropertyToEntityType($orderType, 'ShipCity', 'String');
        $metadataManager->addPropertyToEntityType($orderType, 'ShipRegion', 'String');
        $metadataManager->addPropertyToEntityType($orderType, 'ShipPostalCode', 'String');
        $metadataManager->addPropertyToEntityType($orderType, 'ShipCountry', 'String');
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        list($productType, $result) = $metadataManager->addEntityType('Product');
        assert($productType instanceof TEntityTypeType, get_class($productType));
        $metadataManager->addPropertyToEntityType($productType, 'ProductID', 'Int32', null, false, true, 'Identity');
        $metadataManager->addPropertyToEntityType($productType, 'ProductName', 'String');
        $metadataManager->addPropertyToEntityType($productType, 'SupplierID', 'Int32');
        $metadataManager->addPropertyToEntityType($productType, 'CategoryID', 'Int32');
        $metadataManager->addPropertyToEntityType($productType, 'QuantityPerUnit', 'String');
        $metadataManager->addPropertyToEntityType($productType, 'UnitPrice', 'Decimal');
        $metadataManager->addPropertyToEntityType($productType, 'UnitsInStock', 'Int16');
        $metadataManager->addPropertyToEntityType($productType, 'UnitsOnOrder', 'Int16');
        $metadataManager->addPropertyToEntityType($productType, 'ReorderLevel', 'Int16');
        $metadataManager->addPropertyToEntityType($productType, 'Discontinued', 'Boolean');
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        $expectedRelation = 'Data.Category_Products_Product_Category';
        list($principalNav, ) = $metadataManager->addNavigationPropertyToEntityType(
            $categoryType, '*', 'Products', $productType, '1', 'Category', ['CategoryID'], ['CategoryID']
        );
        $this->assertEquals($expectedRelation, $principalNav->getRelationship());
        $metadataManager->addNavigationPropertyToEntityType(
            $orderDetailType, '1', 'Order', $productType, '*', 'Order_Details', ['OrderID'], ['CategoryID']
        );
//        <NavigationProperty Name="Order_Details" Relationship="NorthwindModel.FK_Order_Details_Products" ToRole="Order_Details" FromRole="Products"/>


        $msg = null;
        $edmx = $metadataManager->getEdmx();
        $this->assertTrue($edmx->isOK($msg), $msg);
        $this->assertNull($msg);

        $d = $metadataManager->getEdmxXML();
        $categoryEType = null;
        $dom = new \DOMDocument();
        $dom->loadXML($d);
        foreach ($dom->getElementsByTagName('EntityType') as $eType) {
            foreach ($eType->attributes as $aType) {
                if ($aType->name == 'Name' && $aType->value == 'Category') {
                    $categoryEType = $eType;
                }
            }
        }
        $this->assertNotNull($categoryEType, 'Count not find the category entity Type to get the navigation property');
        $this->assertEquals('Products', $categoryEType->getElementsByTagName('NavigationProperty')[0]->getAttribute('Name'), 'the product relationship was not found');
        $ProductRelationship = $categoryEType->getElementsByTagName('NavigationProperty')[0]->getAttribute('Relationship');
        $ProductToRole = $categoryEType->getElementsByTagName('NavigationProperty')[0]->getAttribute('ToRole');
        $ProductFromRole = $categoryEType->getElementsByTagName('NavigationProperty')[0]->getAttribute('FromRole');
        $associationType = null;
        foreach ($dom->getElementsByTagName('Association') as $eType) {
            foreach ($eType->attributes as $aType) {
                if ($aType->name == 'Name' && 'Data.'.$aType->value == $ProductRelationship) {
                    $associationType = $eType;
                }
            }
        }
        $this->assertNotNull($associationType, 'count not find a matching assocation for the category');
        foreach ($associationType->getElementsByTagName('End') as $childNode) {
            if ($childNode->getAttribute('Role') == $ProductToRole) {
                $this->assertEquals('Data.Product', $childNode->getAttribute('Type'));
                $this->assertEquals('1', $childNode->getAttribute('Multiplicity'));
            } elseif ($childNode->getAttribute('Role') == $ProductFromRole) {
                $this->assertEquals('Data.Category', $childNode->getAttribute('Type'));
                $this->assertEquals('*', $childNode->getAttribute('Multiplicity'));
            } else {
                throw new \Exception('Some how we ended up with an end role that was not in the NavigationProperty');
            }
        }
    }
}
