<?php

namespace AlgoWeb\ODataMetadata\Tests\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityContainer;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class EntityContainerTest extends TestCase
{

    public static function getEntityContainer(){
        $entityContainer = new EntityContainer("NorthwindEntities", true,null,true);

        $entitySetarray = [
            ['Categories','NorthwindModel.Category'],
            ['CustomerDemographics','NorthwindModel.CustomerDemographic'],
            ['Customers','NorthwindModel.Customer'],
            ['Employees','NorthwindModel.Employee'],
            ['Order_Details','NorthwindModel.Order_Detail'],
            ['Orders','NorthwindModel.Order'],
            ['Products','NorthwindModel.Product'],
            ['Regions','NorthwindModel.Region'],
            ['Shippers','NorthwindModel.Shipper'],
            ['Suppliers','NorthwindModel.Supplier'],
            ['Territories','NorthwindModel.Territory'],
            ['Alphabetical_list_of_products','NorthwindModel.Alphabetical_list_of_product'],
            ['Category_Sales_for_1997','NorthwindModel.Category_Sales_for_1997'],
            ['Current_Product_Lists','NorthwindModel.Current_Product_List'],
            ['Customer_and_Suppliers_by_Cities','NorthwindModel.Customer_and_Suppliers_by_City'],
            ['Invoices','NorthwindModel.Invoice'],
            ['Order_Details_Extendeds','NorthwindModel.Order_Details_Extended'],
            ['Order_Subtotals','NorthwindModel.Order_Subtotal'],
            ['Orders_Qries','NorthwindModel.Orders_Qry'],
            ['Product_Sales_for_1997','NorthwindModel.Product_Sales_for_1997'],
            ['Products_Above_Average_Prices','NorthwindModel.Products_Above_Average_Price'],
            ['Products_by_Categories','NorthwindModel.Products_by_Category'],
            ['Sales_by_Categories','NorthwindModel.Sales_by_Category'],
            ['Sales_Totals_by_Amounts','NorthwindModel.Sales_Totals_by_Amount'],
            ['Summary_of_Sales_by_Quarters','NorthwindModel.Summary_of_Sales_by_Quarter'],
            ['Summary_of_Sales_by_Years','NorthwindModel.Summary_of_Sales_by_Year'],
        ];
        foreach($entitySetarray as $es){
            $entityContainer->addToEntitySet(new EntityContainer\EntitySet($es[0],$es[1]));
        }
        $assocationSetArray = [
            new EntityContainer\AssociationSet("FK_Products_Categories",
                "NorthwindModel.FK_Products_Categories",
                new EntityContainer\AssociationSet\End("Categories","Categories"),
                new EntityContainer\AssociationSet\End("Products","Products")
            ),
            new EntityContainer\AssociationSet("CustomerCustomerDemo",
                "NorthwindModel.CustomerCustomerDemo",
                new EntityContainer\AssociationSet\End("CustomerDemographics","CustomerDemographics"),
                new EntityContainer\AssociationSet\End("Customers","Customers")
            ),
            new EntityContainer\AssociationSet("FK_Orders_Customers",
                "NorthwindModel.FK_Orders_Customers",
                new EntityContainer\AssociationSet\End("Customers","Customers"),
                new EntityContainer\AssociationSet\End("Orders","Orders")
            ),
            new EntityContainer\AssociationSet("FK_Employees_Employees",
                "NorthwindModel.FK_Employees_Employees",
                new EntityContainer\AssociationSet\End("Employees","Employees"),
                new EntityContainer\AssociationSet\End("Employees","Employees1")
            ),
            new EntityContainer\AssociationSet("FK_Orders_Employees",
                "NorthwindModel.FK_Orders_Employees",
                new EntityContainer\AssociationSet\End("Employees","Employees"),
                new EntityContainer\AssociationSet\End("Orders","Orders")
            ),
            new EntityContainer\AssociationSet("EmployeeTerritories",
                "NorthwindModel.EmployeeTerritories",
                new EntityContainer\AssociationSet\End("Employees","Employees"),
                new EntityContainer\AssociationSet\End("Territories","Territories")
            ),
            new EntityContainer\AssociationSet("FK_Order_Details_Orders",
                "NorthwindModel.FK_Order_Details_Orders",
                new EntityContainer\AssociationSet\End("Order_Details","Order_Details"),
                new EntityContainer\AssociationSet\End("Orders","Orders")
            ),
            new EntityContainer\AssociationSet("FK_Order_Details_Products",
                "NorthwindModel.FK_Order_Details_Products",
                new EntityContainer\AssociationSet\End("Order_Details","Order_Details"),
                new EntityContainer\AssociationSet\End("Products","Products")
            ),
            new EntityContainer\AssociationSet("FK_Orders_Shippers",
                "NorthwindModel.FK_Orders_Shippers",
                new EntityContainer\AssociationSet\End("Orders","Orders"),
                new EntityContainer\AssociationSet\End("Shippers","Shippers")
            ),
            new EntityContainer\AssociationSet("FK_Products_Suppliers",
                "NorthwindModel.FK_Products_Suppliers",
                new EntityContainer\AssociationSet\End("Products","Products"),
                new EntityContainer\AssociationSet\End("Suppliers","Suppliers")
            ),
            new EntityContainer\AssociationSet("FK_Territories_Region",
                "NorthwindModel.FK_Territories_Region",
                new EntityContainer\AssociationSet\End("Regions","Region"),
                new EntityContainer\AssociationSet\End("Territories","Territories")
            ),
        ];
        $entityContainer->setAssociationSet($assocationSetArray);
        return $entityContainer;
    }

    public function testXmlSerialize(){
        $domNode =  $this->TESTNODE;
        $entityContainer = self::getEntityContainer();
        $domNode = $this->writterContext->write($entityContainer, false);
        $this->TESTNODE->appendChild($domNode);
        $xml = $this->writterContext->getBaseDocument()->saveXML($domNode);
        /*echo $xml;
        die();*/
        $this->assertXmlStringEqualsXmlString('<EntityContainer xmlns:annotations="http://schemas.microsoft.com/ado/2009/02/edm/annotation" Name="NorthwindEntities" metadata:IsDefaultEntityContainer="true"
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
            </EntityContainer>', $xml);
    }
/*
 *
 */
}
