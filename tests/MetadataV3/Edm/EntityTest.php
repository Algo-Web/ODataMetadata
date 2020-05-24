<?php

namespace AlgoWeb\ODataMetadata\Tests\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\Entity;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityType\NavigationProperty;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Property;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\PropertyRef;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class EntityTest extends TestCase
{

    public function testEntityTestXmlSerialize()
    {
        $expected =
            '<EntityType Abstract="false" Name="Customer" OpenType="false"  metadata:HasStream="false">' .
            '    <Key>'.
            '        <PropertyRef Name="CustomerId" />'.
            '    </Key>'.
            '    <NavigationProperty Name="Orders" Relationship="Model1.CustomerOrder" FromRole="Customer" ToRole="Order"/>'.
            '    <Property Name="CustomerId" Type="Int32" Nullable="false"/>'.
            '    <Property Name="FirstName" Type="String" Nullable="true" Unicode="true"/>'.
            '    <Property Name="LastName" Type="String" Nullable="true" Unicode="true"/>'.
            '    <Property Name="AccountNumber" Type="Int32" Nullable="true"/>'.
            '</EntityType>';

        $entity = new Entity("Customer");

        $entity->addToKey(new PropertyRef('CustomerId'))
            ->addToProperty(new Property('CustomerId', 'Int32',false))
            ->addToProperty(new Property('FirstName', 'String',true))
            ->addToProperty(new Property('LastName', 'String',true))
            ->addToProperty(new Property('AccountNumber', 'Int32',true))
            ->addToNavigationProperty(new NavigationProperty('Orders','Model1.CustomerOrder', 'Order', 'Customer'));

        $domNode = $this->writterContext->write($entity, false);
        $this->TESTNODE->appendChild($domNode);
        $xml = $this->writterContext->getBaseDocument()->saveXML($domNode);
        $this->assertXmlStringEqualsXmlString($expected, $xml);

    }
}
