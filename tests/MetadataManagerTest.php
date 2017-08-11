<?php

namespace AlgoWeb\ODataMetadata\Tests;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataManager;
use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer;
use AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\EntitySetAnonymousType;
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
use AlgoWeb\ODataMetadata\MetadataV3\edmx\TDataServicesType;
use Mockery as m;

class MetadataManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testIsOKAtDefault()
    {
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

        $goodxsd = dirname(__DIR__) . $ds . 'xsd' . $ds . 'Microsoft.Data.Entity.Design.Edmx_3.Fixed.xsd';
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

        list($eType, $result) = $metadataManager->addEntityType('Category');
        $this->assertNotFalse($eType, 'Etype is false not type ' . $metadataManager->getLastError());
        $metadataManager->addPropertyToEntityType($eType, 'CategoryID', 'Int32', null, false, true, 'Identity');
        $metadataManager->addPropertyToEntityType($eType, 'CategoryName', 'String');
        $metadataManager->addPropertyToEntityType($eType, 'Description', 'String');
        $metadataManager->addPropertyToEntityType($eType, 'Picture', 'Binary');

        list($eType, $result) = $metadataManager->addEntityType('CustomerDemographic');
        $metadataManager->addPropertyToEntityType($eType, 'CustomerTypeID', 'String', null, false, true);
        $metadataManager->addPropertyToEntityType($eType, 'CustomerDesc', 'String');

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

        list($categoryType, $result) = $metadataManager->addEntityType('Category');
        $this->assertNotFalse($categoryType, 'Etype is false not type ' . $metadataManager->getLastError());
        $metadataManager->addPropertyToEntityType($categoryType, 'CategoryID', 'Int32', null, false, true, 'Identity');
        $metadataManager->addPropertyToEntityType($categoryType, 'CategoryName', 'String');
        $metadataManager->addPropertyToEntityType($categoryType, 'Description', 'String');
        $metadataManager->addPropertyToEntityType($categoryType, 'Picture', 'Binary');
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        list($customerDemographicType, $result) = $metadataManager->addEntityType('CustomerDemographic');
        $metadataManager->addPropertyToEntityType($customerDemographicType, 'CustomerTypeID', 'String', null, false, true);
        $metadataManager->addPropertyToEntityType($customerDemographicType, 'CustomerDesc', 'String');
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        list($customerType, $result) = $metadataManager->addEntityType('Customer');
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
        $metadataManager->addPropertyToEntityType($orderDetailType, 'OrderID', 'Int32', null, false, true);
        $metadataManager->addPropertyToEntityType($orderDetailType, 'ProductID', 'Int32', null, false, true);
        $metadataManager->addPropertyToEntityType($orderDetailType, 'UnitPrice', 'Decimal');
        $metadataManager->addPropertyToEntityType($orderDetailType, 'Quantity', 'Int16');
        $metadataManager->addPropertyToEntityType($orderDetailType, 'Discount', 'Single');
        $this->assertTrue($metadataManager->getEdmx()->isOK($msg), $msg);

        list($orderType, $result) = $metadataManager->addEntityType('Order');
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
        $this->v3MetadataAgainstXSD($d);
    }

    public function testAddManyToManyNavProperty()
    {
        list($msg, $metadataManager, $categoryType, $customerType) = $this->setUpMetadataForNavTests();

        $expectedRelation = 'Data.Category_custom_Customer_categor';
        list($principal, $dependent) = $metadataManager->addNavigationPropertyToEntityType(
            $categoryType,
            '*',
            'custom',
            $customerType,
            '*',
            'categor'
        );
        $this->assertEquals($principal->getFromRole(), $dependent->getToRole());
        $this->assertEquals($dependent->getFromRole(), $principal->getToRole());
        $this->assertEquals('custom', $principal->getName());
        $this->assertEquals('categor', $dependent->getName());
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
        list($msg, $metadataManager, $categoryType, $customerType) = $this->setUpMetadataForNavTests();

        list($principal, $dependent) = $metadataManager->addNavigationPropertyToEntityType(
            $categoryType,
            '*',
            'custom',
            $customerType,
            '1',
            'categor'
        );
        $this->assertEquals($principal->getFromRole(), $dependent->getToRole());
        $this->assertEquals($dependent->getFromRole(), $principal->getToRole());
        $this->assertEquals('custom', $principal->getName());
        $this->assertEquals('categor', $dependent->getName());

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
        list($msg, $metadataManager, $categoryType, $customerType) = $this->setUpMetadataForNavTests();

        list($principal, $dependent) = $metadataManager->addNavigationPropertyToEntityType(
            $categoryType,
            '1',
            'custom',
            $customerType,
            '*',
            'categor'
        );
        $this->assertEquals($principal->getFromRole(), $dependent->getToRole());
        $this->assertEquals($dependent->getFromRole(), $principal->getToRole());
        $this->assertEquals('custom', $principal->getName());
        $this->assertEquals('categor', $dependent->getName());

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
        list($msg, $metadataManager, $categoryType, $customerType) = $this->setUpMetadataForNavTests();

        list($principal, $dependent) = $metadataManager->addNavigationPropertyToEntityType(
            $categoryType,
            '0..1',
            'custom',
            $customerType,
            '1',
            'categor'
        );
        $this->assertEquals($principal->getFromRole(), $dependent->getToRole());
        $this->assertEquals($dependent->getFromRole(), $principal->getToRole());
        $this->assertEquals('custom', $principal->getName());
        $this->assertEquals('categor', $dependent->getName());

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
        list($msg, $metadataManager, $categoryType, $customerType) = $this->setUpMetadataForNavTests();

        list($principal, $dependent) = $metadataManager->addNavigationPropertyToEntityType(
            $categoryType,
            '1',
            'custom',
            $customerType,
            '0..1',
            'categor'
        );
        $this->assertEquals($principal->getFromRole(), $dependent->getToRole());
        $this->assertEquals($dependent->getFromRole(), $principal->getToRole());
        $this->assertEquals('custom', $principal->getName());
        $this->assertEquals('categor', $dependent->getName());

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

        $expected = 'Expected return type must be either TEntityType or TComplexType';
        $actual = null;

        try {
            $foo->createSingleton(null, $returnType, null);
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

        $expected = 'Name must be a non-empty string';
        $actual = null;

        try {
            $foo->createSingleton(null, $returnType, null);
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

        $expected = 'Name must be a non-empty string';
        $actual = null;

        try {
            $foo->createSingleton($returnType, $returnType, null);
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testCreateSingletonSuccessful()
    {
        $msg = null;
        $name = 'singleton';
        $returnType = m::mock(TEntityTypeType::class)->makePartial();
        $returnType->shouldReceive('getName')->andReturn('doubleton');

        $entityContainer = m::mock(EntityContainer::class)->makePartial();
        $entityContainer->shouldReceive('addToFunctionImport')->andReturn(null)->once();

        $schema = m::mock(Schema::class)->makePartial();
        $schema->shouldReceive('getEntityContainer')->andReturn([$entityContainer])->once();

        $services = m::mock(TDataServicesType::class);
        $services->shouldReceive('getSchema')->andReturn([$schema])->once();

        $edmx = m::mock(Edmx::class)->makePartial();
        $edmx->shouldReceive('getDataServiceType')->andReturn($services);

        $foo = m::mock(MetadataManager::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $foo->shouldReceive('getEdmx')->andReturn($edmx);
        $foo->shouldReceive('getNamespace')->andReturn('Data')->atLeast(1);

        $result = $foo->createSingleton($name, $returnType);
        $this->assertTrue($result instanceof EntityContainer\FunctionImportAnonymousType, get_class($result));
        $this->assertTrue($result->isOK($msg));
        $this->assertNull($result->getDocumentation());
    }

    public function testCreateSingletonSuccessfulWithEntitySet()
    {
        $msg = null;
        $name = 'singleton';
        $returnType = m::mock(TEntityTypeType::class)->makePartial();
        $returnType->shouldReceive('getName')->andReturn('doubleton');

        $entityContainer = m::mock(EntityContainer::class)->makePartial();
        $entityContainer->shouldReceive('addToFunctionImport')->andReturn(null)->once();

        $schema = m::mock(Schema::class)->makePartial();
        $schema->shouldReceive('getEntityContainer')->andReturn([$entityContainer])->once();

        $services = m::mock(TDataServicesType::class);
        $services->shouldReceive('getSchema')->andReturn([$schema])->once();

        $edmx = m::mock(Edmx::class)->makePartial();
        $edmx->shouldReceive('getDataServiceType')->andReturn($services);

        $foo = m::mock(MetadataManager::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $foo->shouldReceive('getEdmx')->andReturn($edmx);
        $foo->shouldReceive('getNamespace')->andReturn('Data')->atLeast(1);

        $entitySet = m::mock(EntitySetAnonymousType::class);
        $entitySet->shouldReceive('getName')->andReturn('BorkBorkBorken')->atLeast(1);

        $result = $foo->createSingleton($name, $returnType, $entitySet);
        $this->assertTrue($result instanceof EntityContainer\FunctionImportAnonymousType, get_class($result));
        $this->assertTrue($result->isOK($msg));
        $this->assertNull($result->getDocumentation());
        $this->assertEquals('BorkBorkBorken', $result->getReturnType()[0]->getEntitySetAttribute());
    }

    public function testCreateSingletonWithDocumentation()
    {
        $msg = null;
        $name = 'singleton';
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

        $foo = m::mock(MetadataManager::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $foo->shouldReceive('getEdmx')->andReturn($edmx);
        $foo->shouldReceive('getNamespace')->andReturn('Data')->atLeast(1);

        $result = $foo->createSingleton($name, $returnType, null, $shortDesc, $longDesc);
        $this->assertTrue($result instanceof EntityContainer\FunctionImportAnonymousType, get_class($result));
        $this->assertTrue($result->isOK($msg));
        $this->assertNotNull($result->getDocumentation());
    }

    public function testCreateSingletonWithDocumentationOnlyShortDesc()
    {
        $msg = null;
        $name = 'singleton';
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

        $foo = m::mock(MetadataManager::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $foo->shouldReceive('getEdmx')->andReturn($edmx);
        $foo->shouldReceive('getNamespace')->andReturn('Data')->atLeast(1);

        $result = $foo->createSingleton($name, $returnType, null, $shortDesc, $longDesc);
        $this->assertTrue($result instanceof EntityContainer\FunctionImportAnonymousType, get_class($result));
        $this->assertTrue($result->isOK($msg));
        $this->assertNull($result->getDocumentation());
    }

    public function testCreateSingletonWithDocumentationOnlyLongDesc()
    {
        $msg = null;
        $name = 'singleton';
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

        $foo = m::mock(MetadataManager::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $foo->shouldReceive('getEdmx')->andReturn($edmx);
        $foo->shouldReceive('getNamespace')->andReturn('Data')->atLeast(1);

        $result = $foo->createSingleton($name, $returnType, $shortDesc, $longDesc);
        $this->assertTrue($result instanceof EntityContainer\FunctionImportAnonymousType, get_class($result));
        $this->assertTrue($result->isOK($msg));
        $this->assertNull($result->getDocumentation());
    }

    public function testMalformedMultiplicity()
    {
        list(, $metadataManager, $categoryType, $customerType) = $this->setUpMetadataForNavTests();

        $expected = 'Malformed multiplicity - valid values are *, 0..1 and 1';
        $actual = null;

        try {
            $metadataManager->addNavigationPropertyToEntityType(
                $categoryType,
                '1',
                'Customers',
                $customerType,
                'ABC',
                'Categories'
            );
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testInvalidMultiplicityBelongsOnBothEnds()
    {
        list(, $metadataManager, $categoryType, $customerType) = $this->setUpMetadataForNavTests();

        $expected =  'Invalid multiplicity combination - 1 1';
        $actual = null;

        try {
            $metadataManager->addNavigationPropertyToEntityType(
                $categoryType,
                '1',
                'Customers',
                $customerType,
                '1',
                'Categories'
            );
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testInvalidMultiplicityManyToHasMany()
    {
        list(, $metadataManager, $categoryType, $customerType) = $this->setUpMetadataForNavTests();

        $expected =  'Invalid multiplicity combination - * 0..1';
        $actual = null;

        try {
            $metadataManager->addNavigationPropertyToEntityType(
                $categoryType,
                '*',
                'Customers',
                $customerType,
                '0..1',
                'Categories'
            );
        } catch (\InvalidArgumentException $e) {
            $actual = $e->getMessage();
        }
        $this->assertEquals($expected, $actual);
    }

    public function testAddComplexType()
    {
        list(, $metadataManager, , ) = $this->setUpMetadataForNavTests();

        $name = 'Name';
        $accessType = 'Public';
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

        $name = 'Name';
        $accessType = 'Public';
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

        $name = 'Name';
        $accessType = 'Public';
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
        $expected = 'Default value cannot be object or array';
        $actual = null;

        list(, $metadataManager, , ) = $this->setUpMetadataForNavTests();
        $complex = m::mock(TComplexTypeType::class);
        $name = 'name';
        $type = 'type';
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
        $expected = 'Default value cannot be object or array';
        $actual = null;

        list(, $metadataManager, , ) = $this->setUpMetadataForNavTests();
        $complex = m::mock(TComplexTypeType::class);
        $name = 'name';
        $type = 'type';
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
        $name = 'name';
        $type = 'type';
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
        $name = 'name';
        $type = 'type';
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
        $name = 'name';
        $type = 'type';
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
        $name = 'name';
        $type = 'type';
        $summary = new TTextType();
        $defaultValue = 'true';
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
        $this->assertEquals('true', $result->getDefaultValue());
    }

    public function testAddPropertyToEntityTypeOnlySummary()
    {
        $metadataManager = new MetadataManager();
        $entity = m::mock(TEntityTypeType::class);
        $entity->shouldReceive('addToProperty')
            ->with(m::type(TEntityPropertyType::class))->andReturnNull()->once();
        $name = 'name';
        $type = 'type';
        $summary = new TTextType();
        $defaultValue = 'true';
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
        $this->assertEquals('true', $result->getDefaultValue());
    }

    public function testAddPropertyToEntityTypeOnlyDescription()
    {
        $metadataManager = new MetadataManager();
        $entity = m::mock(TEntityTypeType::class);
        $entity->shouldReceive('addToProperty')
            ->with(m::type(TEntityPropertyType::class))->andReturnNull()->once();
        $name = 'name';
        $type = 'type';
        $summary = null;
        $defaultValue = 'true';
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
        $this->assertEquals('true', $result->getDefaultValue());
    }

    public function testAddEntityTypeWithDocumentation()
    {
        $name = 'name';
        $accessType = 'Public';
        $summary = new TTextType();
        $longDescription = new TTextType();

        $metadataManager = new MetadataManager();
        list($result, ) = $metadataManager->addEntityType($name, null, false, $accessType, $summary, $longDescription);
        $this->assertNotNull($result->getDocumentation());
    }

    public function testAddEntityTypeWithDocumentationFromOnlySummary()
    {
        $name = 'name';
        $accessType = 'Public';
        $summary = new TTextType();
        $longDescription = null;

        $metadataManager = new MetadataManager();
        list($result, ) = $metadataManager->addEntityType($name, null, false, $accessType, $summary, $longDescription);
        $this->assertNull($result->getDocumentation());
    }

    public function testAddEntityTypeWithDocumentationFromOnlyDocumentation()
    {
        $name = 'name';
        $accessType = 'Public';
        $summary = null;
        $longDescription = new TTextType();

        $metadataManager = new MetadataManager();
        list($result, ) = $metadataManager->addEntityType($name, null, false, $accessType, $summary, $longDescription);
        $this->assertNull($result->getDocumentation());
    }

    public function testAddNavigationPropertyToEntityTypeWithDocumentation()
    {
        list(, $metadataManager, $categoryType, $customerType) = $this->setUpMetadataForNavTests();

        $summary = new TTextType();
        $longDescription = new TTextType();
        $mult = '*';
        $principalProperty = 'Categories';
        $dependentProperty = 'Customers';

        list($principal, $dependent) = $metadataManager
            ->addNavigationPropertyToEntityType(
                $categoryType,
                $mult,
                $principalProperty,
                $customerType,
                $mult,
                $dependentProperty,
                null,
                null,
                'Public',
                'Public',
                'Public',
                'Public',
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
        list(, $metadataManager, $categoryType, $customerType) = $this->setUpMetadataForNavTests();

        $summary = null;
        $longDescription = new TTextType();
        $mult = '*';
        $principalProperty = 'Categories';
        $dependentProperty = 'Customers';

        list($principal, $dependent) = $metadataManager
            ->addNavigationPropertyToEntityType(
                $categoryType,
                $mult,
                $principalProperty,
                $customerType,
                $mult,
                $dependentProperty,
                null,
                null,
                'Public',
                'Public',
                'Public',
                'Public',
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
        list(, $metadataManager, $categoryType, $customerType) = $this->setUpMetadataForNavTests();

        $summary = new TTextType();
        $longDescription = null;
        $mult = '*';
        $principalProperty = 'Categories';
        $dependentProperty = 'Customers';

        list($principal, $dependent) = $metadataManager
            ->addNavigationPropertyToEntityType(
                $categoryType,
                $mult,
                $principalProperty,
                $customerType,
                $mult,
                $dependentProperty,
                null,
                null,
                'Public',
                'Public',
                'Public',
                'Public',
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

        $expected = 'If you have both a dependent property and a principal property, relationship should match';
        $actual = null;

        try {
            $metadataManager->createAssocationFromNavigationProperty(
                $principalType,
                $dependentType,
                $principalNav,
                $dependentNav,
                '*',
                '*'
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

        $expected = 'Principal to role should match dependent from role, and vice versa';
        $actual = null;

        try {
            $metadataManager->createAssocationFromNavigationProperty(
                $principalType,
                $dependentType,
                $principalNav,
                $dependentNav,
                '*',
                '*'
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

        $expected = 'Principal to role should match dependent from role, and vice versa';
        $actual = null;

        try {
            $metadataManager->createAssocationFromNavigationProperty(
                $principalType,
                $dependentType,
                $principalNav,
                $dependentNav,
                '*',
                '*'
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
        $metadataManager = new MetadataManager('Data', 'Container');
        $expectedCategorySetName = 'Categories';
        $expectedCustomerSetName = 'Customers';

        list($categoryType, $categorySet) = $metadataManager->addEntityType('Category');
        list($customerType, $customerSet) = $metadataManager->addEntityType('Customer');
        $this->assertTrue($categoryType->isOK($msg), $msg);
        $this->assertTrue($customerType->isOK($msg), $msg);
        $this->assertEquals($expectedCategorySetName, $categorySet->getName());
        $this->assertEquals($expectedCustomerSetName, $customerSet->getName());
        return [$msg, $metadataManager, $categoryType, $customerType];
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
            $this->assertTrue($fromMatch, 'toRole must match at least one end role');
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
