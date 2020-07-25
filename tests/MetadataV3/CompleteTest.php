<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\MetadataV3;

use AlgoWeb\ODataMetadata\Csdl\EdmxWriter;
use AlgoWeb\ODataMetadata\Enums\Multiplicity;
use AlgoWeb\ODataMetadata\Library\EdmEntityContainer;
use AlgoWeb\ODataMetadata\Library\EdmEntityType;
use AlgoWeb\ODataMetadata\Library\EdmModel;
use AlgoWeb\ODataMetadata\Library\EdmNavigationPropertyInfo;
use AlgoWeb\ODataMetadata\Tests\Northwind\Facets\Structure;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use XMLWriter;

class CompleteTest extends TestCase
{
    public function testFromFascet()
    {
        $customer        = Structure::getCustomers();
        $employPriv      = Structure::getEmployeePrivileges();
        $employ          = Structure::getEmployees();
        $model           = new EdmModel();
        $entityContainer = new EdmEntityContainer('Northwind', 'NorthwindEntities', true, true);
        $model->AddElement(array_values($customer)[0]);
        $customerSet = $entityContainer->AddEntitySet(array_keys($customer)[0], array_values($customer)[0]);
        $model->AddElement(array_values($employPriv)[0]);
        $EmployPrivSet = $entityContainer->AddEntitySet(array_keys($employPriv)[0], array_values($employPriv)[0]);
        $model->AddElement(array_values($employ)[0]);
        $employSet = $entityContainer->AddEntitySet(array_keys($employ)[0], array_values($employ)[0]);
        $model->AddElement($entityContainer);
        /**
         * @var EdmEntityType $employee
         */
        $employee                         = array_values($employ)[0];
        $navPropInfo                      = new EdmNavigationPropertyInfo();
        $navPropInfo->name                = 'priv';
        $navPropInfo->targetMultiplicity  = Multiplicity::Many();
        $navPropInfo->target              = array_values($employPriv)[0];
        $navPropInfo1                     = new EdmNavigationPropertyInfo();
        $navPropInfo1->name               = 'employee';
        $navPropInfo1->targetMultiplicity = Multiplicity::One();
        $navProp                          = $employee->AddBidirectionalNavigation($navPropInfo, $navPropInfo1);
        $employSet->addNavigationTarget($navProp, $EmployPrivSet);
        $xmlWritter = new XMLWriter();
        $this->assertTrue(EdmxWriter::TryWriteEdmx($model, $xmlWritter));
        $this->assertXmlStringEqualsXmlString('<?xml version="1.0"?>
<edmx:Edmx xmlns="http://schemas.microsoft.com/ado/2009/11/edm" xmlns:metadata="http://schemas.microsoft.com/ado/2007/08/dataservices/metadata" xmlns:annotations="http://schemas.microsoft.com/ado/2009/02/edm/annotation" Version="3.0" xmlns:edmx="http://schemas.microsoft.com/ado/2009/11/edmx">
   <edmx:DataServices metadata:DataServiceVersion="3.0" xmlns:metadata="http://schemas.microsoft.com/ado/2007/08/dataservices/metadata">
      <Schema Namespace="Northwind">
         <EntityType Name="customer" OpenType="true">
            <Property Name="id" Type="Edm.Int32" ConcurrencyMode="None" Nullable="false"/>
            <Property Name="company" Type="Edm.String" ConcurrencyMode="None" MaxLength="50" FixedLength="false"/>
            <Property Name="last_name" Type="Edm.String" ConcurrencyMode="None" MaxLength="50" FixedLength="false"/>
            <Property Name="email_address" Type="Edm.String" ConcurrencyMode="None" MaxLength="50" FixedLength="false"/>
            <Property Name="job_title" Type="Edm.String" ConcurrencyMode="None" MaxLength="50" FixedLength="false"/>
            <Property Name="business_phone" Type="Edm.String" ConcurrencyMode="None" MaxLength="25" FixedLength="false"/>
            <Property Name="home_phone" Type="Edm.String" ConcurrencyMode="None" MaxLength="25" FixedLength="false"/>
            <Property Name="mobile_phone" Type="Edm.String" ConcurrencyMode="None" MaxLength="25" FixedLength="false"/>
            <Property Name="fax_number" Type="Edm.String" ConcurrencyMode="None" MaxLength="25" FixedLength="false"/>
            <Property Name="address" Type="Edm.String" ConcurrencyMode="None" MaxLength="Max"/>
            <Property Name="city" Type="Edm.String" ConcurrencyMode="None" MaxLength="50" FixedLength="false"/>
            <Property Name="state_province" Type="Edm.String" ConcurrencyMode="None" MaxLength="50" FixedLength="false"/>
            <Property Name="zip_postal_code" Type="Edm.String" ConcurrencyMode="None" MaxLength="15" FixedLength="false"/>
            <Property Name="country_region" Type="Edm.String" ConcurrencyMode="None" MaxLength="50" FixedLength="false"/>
            <Property Name="web_page" Type="Edm.String" ConcurrencyMode="None" MaxLength="Max"/>
            <Property Name="notes" Type="Edm.String" ConcurrencyMode="None" MaxLength="Max"/>
            <Property Name="attachments" Type="Edm.Binary" ConcurrencyMode="None" MaxLength="Max"/>
         </EntityType>
         <EntityType Name="EmployeePrivilege" OpenType="true">
            <Property Name="employee_id" Type="Edm.Int32" ConcurrencyMode="None" Nullable="false"/>
            <Property Name="privilege_id" Type="Edm.Int32" ConcurrencyMode="None" Nullable="false"/>
            <NavigationProperty Name="employee" Relationship="Northwind.Northwind_Northwind_employee_Northwind_Northwind_priv" ToRole="employee" FromRole="priv"/>
         </EntityType>
         <EntityType Name="Employee" OpenType="true">
            <Property Name="id" Type="Edm.Int32" ConcurrencyMode="None" Nullable="false"/>
            <Property Name="company" Type="Edm.String" ConcurrencyMode="None" MaxLength="50" FixedLength="false"/>
            <Property Name="last_name" Type="Edm.String" ConcurrencyMode="None" MaxLength="50" FixedLength="false"/>
            <Property Name="email_address" Type="Edm.String" ConcurrencyMode="None" MaxLength="50" FixedLength="false"/>
            <Property Name="job_title" Type="Edm.String" ConcurrencyMode="None" MaxLength="50" FixedLength="false"/>
            <Property Name="business_phone" Type="Edm.String" ConcurrencyMode="None" MaxLength="25" FixedLength="false"/>
            <Property Name="home_phone" Type="Edm.String" ConcurrencyMode="None" MaxLength="25" FixedLength="false"/>
            <Property Name="mobile_phone" Type="Edm.String" ConcurrencyMode="None" MaxLength="25" FixedLength="false"/>
            <Property Name="fax_number" Type="Edm.String" ConcurrencyMode="None" MaxLength="25" FixedLength="false"/>
            <Property Name="address" Type="Edm.String" ConcurrencyMode="None" MaxLength="Max"/>
            <Property Name="city" Type="Edm.String" ConcurrencyMode="None" MaxLength="50" FixedLength="false"/>
            <Property Name="state_province" Type="Edm.String" ConcurrencyMode="None" MaxLength="50" FixedLength="false"/>
            <Property Name="zip_postal_code" Type="Edm.String" ConcurrencyMode="None" MaxLength="15" FixedLength="false"/>
            <Property Name="country_region" Type="Edm.String" ConcurrencyMode="None" MaxLength="50" FixedLength="false"/>
            <Property Name="web_page" Type="Edm.String" ConcurrencyMode="None" MaxLength="Max"/>
            <Property Name="notes" Type="Edm.String" ConcurrencyMode="None" MaxLength="Max"/>
            <Property Name="attachments" Type="Edm.Binary" ConcurrencyMode="None" MaxLength="Max"/>
            <NavigationProperty Name="priv" Relationship="Northwind.Northwind_Northwind_employee_Northwind_Northwind_priv" ToRole="priv" FromRole="employee"/>
         </EntityType>
         <Association Name="Northwind_Northwind_employee_Northwind_Northwind_priv">
            <End Type="Northwind.Employee" Role="employee" Multiplicity="1"/>
            <End Type="Northwind.EmployeePrivilege" Role="priv" Multiplicity="*"/>
         </Association>
         <EntityContainer Name="NorthwindEntities" metadata:IsDefaultEntityContainer="true" annotations:LazyLoadingEnabled="true">
            <EntitySet Name="Customer" EntityType="Northwind.customer"/>
            <EntitySet Name="EmployeePrivileges" EntityType="Northwind.EmployeePrivilege"/>
            <EntitySet Name="Employees" EntityType="Northwind.Employee"/>
            <AssociationSet Name="Northwind_Northwind_employee_Northwind_Northwind_privSet" Association="Northwind.Northwind_Northwind_employee_Northwind_Northwind_priv">
               <End Role="employee" EntitySet="Employees"/>
               <End Role="priv" EntitySet="EmployeePrivileges"/>
            </AssociationSet>
         </EntityContainer>
      </Schema>
   </edmx:DataServices>
</edmx:Edmx>
', $xmlWritter->outputMemory(true));
    }
}
