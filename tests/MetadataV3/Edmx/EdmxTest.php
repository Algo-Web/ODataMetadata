<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\MetadataV3\Edmx;

use AlgoWeb\ODataMetadata\Csdl\EdmxWriter;
use AlgoWeb\ODataMetadata\Library\EdmEntityContainer;
use AlgoWeb\ODataMetadata\Library\EdmEntitySet;
use AlgoWeb\ODataMetadata\Library\EdmEntityType;
use AlgoWeb\ODataMetadata\Library\EdmModel;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class EdmxTest extends TestCase
{
    public function testEdmxTestXmlSerialize()
    {
        $model    = new EdmModel();
        $xmlWritter = new \XMLWriter();
        $this->assertTrue(EdmxWriter::TryWriteEdmx($model, $xmlWritter));
        $expected = '<edmx:Edmx xmlns="http://schemas.microsoft.com/ado/2009/11/edm" xmlns:annotations="http://schemas.microsoft.com/ado/2009/02/edm/annotation" xmlns:edmx="http://schemas.microsoft.com/ado/2009/11/edmx" xmlns:metadata="http://schemas.microsoft.com/ado/2007/08/dataservices/metadata" Version="3.0">
<edmx:DataServices metadata:DataServiceVersion="3.0"/> </edmx:Edmx>
';
        $this->assertXmlStringEqualsXmlString($expected, $xmlWritter->outputMemory(true));
    }

    public function testEdmxSerializePartialSchema()
    {
        $entitySetarray = [
            ['Categories','Category'],
            ['CustomerDemographics','CustomerDemographic'],
            ['Customers','Customer'],
            ['Employees','Employee'],
            ['Order_Details','Order_Detail'],
            ['Orders','Order'],
            ['Products','Product'],
            ['Regions','Region'],
            ['Shippers','Shipper'],
            ['Suppliers','Supplier'],
            ['Territories','Territory'],
            ['Alphabetical_list_of_products','Alphabetical_list_of_product'],
            ['Category_Sales_for_1997','Category_Sales_for_1997'],
            ['Current_Product_Lists','Current_Product_List'],
            ['Customer_and_Suppliers_by_Cities','Customer_and_Suppliers_by_City'],
            ['Invoices','Invoice'],
            ['Order_Details_Extendeds','Order_Details_Extended'],
            ['Order_Subtotals','Order_Subtotal'],
            ['Orders_Qries','Orders_Qry'],
            ['Product_Sales_for_1997','Product_Sales_for_1997'],
            ['Products_Above_Average_Prices','Products_Above_Average_Price'],
            ['Products_by_Categories','Products_by_Category'],
            ['Sales_by_Categories','Sales_by_Category'],
            ['Sales_Totals_by_Amounts','Sales_Totals_by_Amount'],
            ['Summary_of_Sales_by_Quarters','Summary_of_Sales_by_Quarter'],
            ['Summary_of_Sales_by_Years','Summary_of_Sales_by_Year'],
        ];

        $model    = new EdmModel();
        $entityContainer = new EdmEntityContainer('ODataWebV3.Northwind.Model','NorthwindEntities', true, true);

        foreach ($entitySetarray as $es) {
            $entityType = new EdmEntityType('NorthwindModel',$es[1]);
            $entityContainer->AddEntitySet($es[0], $entityType);
        }
        $model->AddElement($entityContainer);
        $xmlWritter = new \XMLWriter();
        $this->assertTrue(EdmxWriter::TryWriteEdmx($model, $xmlWritter));

        $this->assertXmlStringEqualsXmlString('
<edmx:Edmx xmlns="http://schemas.microsoft.com/ado/2009/11/edm" xmlns:annotations="http://schemas.microsoft.com/ado/2009/02/edm/annotation" xmlns:edmx="http://schemas.microsoft.com/ado/2009/11/edmx" xmlns:metadata="http://schemas.microsoft.com/ado/2007/08/dataservices/metadata" Version="3.0">
  <edmx:DataServices metadata:DataServiceVersion="3.0">
   <Schema Namespace="ODataWebV3.Northwind.Model">
<EntityContainer xmlns:annotations="http://schemas.microsoft.com/ado/2009/02/edm/annotation" Name="NorthwindEntities" metadata:IsDefaultEntityContainer="true"
                             annotations:LazyLoadingEnabled="true">
                <EntitySet Name="Categories" EntityType="NorthwindModel.Category"/>
                <EntitySet Name="CustomerDemographics" EntityType="NorthwindModel.CustomerDemographic"/>
                <EntitySet Name="Customers" EntityType="NorthwindModel.Customer"/>
                <EntitySet Name="Employees" EntityType="NorthwindModel.Employee"/>
                <EntitySet Name="Order_Details" EntityType="NorthwindModel.Order_Detail"/>
                <EntitySet Name="Orders" EntityType="NorthwindModel.Order"/>
                <EntitySet Name="Products" EntityType="NorthwindModel.Product"/>
                <EntitySet Name="Regions" EntityType="NorthwindModel.Region"/>
                <EntitySet Name="Shippers" EntityType="NorthwindModel.Shipper"/>
                <EntitySet Name="Suppliers" EntityType="NorthwindModel.Supplier"/>
                <EntitySet Name="Territories" EntityType="NorthwindModel.Territory"/>
                <EntitySet Name="Alphabetical_list_of_products"
                           EntityType="NorthwindModel.Alphabetical_list_of_product"/>
                <EntitySet Name="Category_Sales_for_1997" EntityType="NorthwindModel.Category_Sales_for_1997"/>
                <EntitySet Name="Current_Product_Lists" EntityType="NorthwindModel.Current_Product_List"/>
                <EntitySet Name="Customer_and_Suppliers_by_Cities"
                           EntityType="NorthwindModel.Customer_and_Suppliers_by_City"/>
                <EntitySet Name="Invoices" EntityType="NorthwindModel.Invoice"/>
                <EntitySet Name="Order_Details_Extendeds" EntityType="NorthwindModel.Order_Details_Extended"/>
                <EntitySet Name="Order_Subtotals" EntityType="NorthwindModel.Order_Subtotal"/>
                <EntitySet Name="Orders_Qries" EntityType="NorthwindModel.Orders_Qry"/>
                <EntitySet Name="Product_Sales_for_1997" EntityType="NorthwindModel.Product_Sales_for_1997"/>
                <EntitySet Name="Products_Above_Average_Prices"
                           EntityType="NorthwindModel.Products_Above_Average_Price"/>
                <EntitySet Name="Products_by_Categories" EntityType="NorthwindModel.Products_by_Category"/>
                <EntitySet Name="Sales_by_Categories" EntityType="NorthwindModel.Sales_by_Category"/>
                <EntitySet Name="Sales_Totals_by_Amounts" EntityType="NorthwindModel.Sales_Totals_by_Amount"/>
                <EntitySet Name="Summary_of_Sales_by_Quarters" EntityType="NorthwindModel.Summary_of_Sales_by_Quarter"/>
                <EntitySet Name="Summary_of_Sales_by_Years" EntityType="NorthwindModel.Summary_of_Sales_by_Year"/>
            </EntityContainer></Schema></edmx:DataServices></edmx:Edmx>', $xmlWritter->outputMemory());
    }
}
