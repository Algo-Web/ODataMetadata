<?php

namespace AlgoWeb\ODataMetadata\Tests\MetadataV3\Edmx;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Schema;
use AlgoWeb\ODataMetadata\MetadataV3\Edmx\Edmx;
use AlgoWeb\ODataMetadata\OdataVersions;
use AlgoWeb\ODataMetadata\Tests\MetadataV3\Edm\EntityContainerTest;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Writer\WriterContext;

class EdmxTest extends TestCase
{

    public function testEdmxTestXmlSerialize()
    {
        $writterContext =  new WriterContext(OdataVersions::THREE());

        $edmx = new Edmx();
        $domNode = $writterContext->write($edmx);
        $writterContext->getBaseDocument()->appendChild($domNode);
        $xml = $writterContext->getBaseDocument()->saveXML($domNode);
        $this->assertXmlStringEqualsXmlString('<edmx:Edmx xmlns="http://schemas.microsoft.com/ado/2009/11/edm" xmlns:annotations="http://schemas.microsoft.com/ado/2009/02/edm/annotation" xmlns:edmx="http://schemas.microsoft.com/ado/2007/06/edmx" xmlns:metadata="http://schemas.microsoft.com/ado/2007/08/DataServices/Metadata" Version="1.0"><edmx:DataServices metadata:DataServiceVersion="3.0"><Schema /></edmx:DataServices></edmx:Edmx>', $xml);
    }

    public function testEdmxSerializePartialSchema(){
        $writterContext =  new WriterContext(OdataVersions::THREE());
        $edmx = new Edmx();
        $schema = new Schema('ODataWebV3.Northwind.Model');
        $edmx->addToDataServices($schema);
        $schema->addToEntityContainer(EntityContainerTest::getEntityContainer());
        $domNode = $writterContext->write($edmx);
        $writterContext->getBaseDocument()->appendChild($domNode);
        $xml = $writterContext->getBaseDocument()->saveXML($domNode);
        $this->assertXmlStringEqualsXmlString('
<edmx:Edmx xmlns="http://schemas.microsoft.com/ado/2009/11/edm" xmlns:annotations="http://schemas.microsoft.com/ado/2009/02/edm/annotation" xmlns:edmx="http://schemas.microsoft.com/ado/2007/06/edmx" xmlns:metadata="http://schemas.microsoft.com/ado/2007/08/DataServices/Metadata" Version="1.0">
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
                <AssociationSet Name="FK_Products_Categories" Association="NorthwindModel.FK_Products_Categories">
                    <End Role="Categories" EntitySet="Categories"/>
                    <End Role="Products" EntitySet="Products"/>
                </AssociationSet>
                <AssociationSet Name="CustomerCustomerDemo" Association="NorthwindModel.CustomerCustomerDemo">
                    <End Role="CustomerDemographics" EntitySet="CustomerDemographics"/>
                    <End Role="Customers" EntitySet="Customers"/>
                </AssociationSet>
                <AssociationSet Name="FK_Orders_Customers" Association="NorthwindModel.FK_Orders_Customers">
                    <End Role="Customers" EntitySet="Customers"/>
                    <End Role="Orders" EntitySet="Orders"/>
                </AssociationSet>
                <AssociationSet Name="FK_Employees_Employees" Association="NorthwindModel.FK_Employees_Employees">
                    <End Role="Employees" EntitySet="Employees"/>
                    <End Role="Employees1" EntitySet="Employees"/>
                </AssociationSet>
                <AssociationSet Name="FK_Orders_Employees" Association="NorthwindModel.FK_Orders_Employees">
                    <End Role="Employees" EntitySet="Employees"/>
                    <End Role="Orders" EntitySet="Orders"/>
                </AssociationSet>
                <AssociationSet Name="EmployeeTerritories" Association="NorthwindModel.EmployeeTerritories">
                    <End Role="Employees" EntitySet="Employees"/>
                    <End Role="Territories" EntitySet="Territories"/>
                </AssociationSet>
                <AssociationSet Name="FK_Order_Details_Orders" Association="NorthwindModel.FK_Order_Details_Orders">
                    <End Role="Order_Details" EntitySet="Order_Details"/>
                    <End Role="Orders" EntitySet="Orders"/>
                </AssociationSet>
                <AssociationSet Name="FK_Order_Details_Products" Association="NorthwindModel.FK_Order_Details_Products">
                    <End Role="Order_Details" EntitySet="Order_Details"/>
                    <End Role="Products" EntitySet="Products"/>
                </AssociationSet>
                <AssociationSet Name="FK_Orders_Shippers" Association="NorthwindModel.FK_Orders_Shippers">
                    <End Role="Orders" EntitySet="Orders"/>
                    <End Role="Shippers" EntitySet="Shippers"/>
                </AssociationSet>
                <AssociationSet Name="FK_Products_Suppliers" Association="NorthwindModel.FK_Products_Suppliers">
                    <End Role="Products" EntitySet="Products"/>
                    <End Role="Suppliers" EntitySet="Suppliers"/>
                </AssociationSet>
                <AssociationSet Name="FK_Territories_Region" Association="NorthwindModel.FK_Territories_Region">
                    <End Role="Region" EntitySet="Regions"/>
                    <End Role="Territories" EntitySet="Territories"/>
                </AssociationSet>
            </EntityContainer></Schema></edmx:DataServices></edmx:Edmx>', $xml);
    }
}
