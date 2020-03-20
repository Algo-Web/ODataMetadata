<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\AccessorType;
use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasAnnotations;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityType\KeyElement;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityType\NavigationPropertyHolder;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityType\PropertyHolder;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\INominalType;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.2 EntityType
 * An entity is an instance of an EntityType element. An EntityType has a unique identity, an independent existence,
 * and forms the operational unit of consistency. EntityType elements model the top-level concepts within a data
 * model--such as customers, orders, suppliers, and so on (to take the example of a typical line-of-business system).
 * An entity instance represents one particular instance of the EntityType, such as a specific customer or a specific
 * order. An EntityType can be either abstract or concrete. An abstract EntityType cannot be instantiated.
 *
 * An EntityType has a Name attribute, a payload consisting of one or more declared properties, and an entity Key
 * (section 2.1.5) element that specifies the set of properties whose values uniquely identify an entity within an
 * entity set. An EntityType can have one or more properties of the specified scalar type or ComplexType. A property
 * can be a declared property or a dynamic property.
 *
 * In CSDL 1.2, CSDL 2.0, and CSDL 3.0, an EntityType can be an OpenEntityType. An EntityType is indicated to be an
 * OpenEntityType by the presence of an OpenType="true" attribute. If an EntityType is an OpenEntityType, the set of
 * properties that are associated with the EntityType can, in addition to declared properties, include dynamic
 * properties.
 *
 * Note In CSDL, dynamic properties are defined for use only with OpenEntityType instances.
 *
 * The type of a Property in an EntityType can be a scalar type or ComplexType. EntityType can be categorized as an EDM
 * type.
 *
 * The following is an example of an EntityType.
 *
 *     <EntityType Name="Customer">
 *         <Key>
 *             <PropertyRef Name="CustomerId" />
 *         </Key>
 *         <Property Name="CustomerId" Type="Int32" Nullable="false" />
 *         <Property Name="FirstName" Type="String" Nullable="true" />
 *         <Property Name="LastName" Type="String" Nullable="true" />
 *         <Property Name="AccountNumber" Type="Int32" Nullable="true" />
 *         <NavigationProperty Name="Orders" Relationship="Model1.CustomerOrder" FromRole="Customer" ToRole="Order" />
 *     </EntityType>
 *
 * The following rules apply to the EntityType element:
 * - EntityType MUST have a Name attribute defined. The Name attribute is of type SimpleIdentifier and represents the
 *   name of this EntityType.
 * - An EntityType is a schema level named element and has a unique name.
 * - EntityType can derive from a BaseType, which is used to specify the parent type of a derived type. The derived
 *   type inherits properties from the parent type.
 * - If a BaseType is defined, it has a namespace qualified name or an alias qualified name of an EntityType that is in
 *   scope.
 * - An EntityType cannot introduce an inheritance cycle via the BaseType attribute.
 * - An EntityType can have its Abstract attribute set to "true". By default, the Abstract attribute is set to "false".
 * - An EntityType can contain any number of AnnotationAttribute attributes, but their full names cannot collide.
 * - An EntityType element can contain at most one Documentation element.
 * - An EntityType either defines an entity Key element or derive from a BaseType. Derived EntityType elements cannot
 *   define an entity Key. A key forms the identity of the Entity.
 * - An EntityType can have any number of Property and NavigationProperty elements in any given order.
 * - EntityTypeProperty child elements are uniquely named within the inheritance hierarchy for the EntityType. Property
 *   child elements and NavigationProperty child elements cannot have the same name as their declaring EntityType.
 * - An EntityType can contain any number of AnnotationElement element blocks.
 * - In CSDL 1.2, CSDL 2.0, and CSDL 3.0, an EntityType that represents an OpenEntityType MUST have an OpenType
 *   attribute that is defined with its value equal to "true".
 * - In CSDL 1.2, CSDL 2.0, and CSDL 3.0, an EntityType that derives from an OpenEntityType is itself an
 *   OpenEntityType. Such a derived EntityType cannot have an OpenType attribute with its value equal to "false", but
 *   the derived EntityType can have an OpenType attribute defined with its value equal to "true".
 * - In CSDL 3.0, EntityType can contain any number of TypeAnnotation elements.
 * - In CSDL 3.0, EntityType can contain any number of ValueAnnotation elements.
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl6.1
 * XSD Type: TEntityType
 */
class Entity extends EdmBase implements INominalType
{
    use HasAnnotations,
        /*
         * An EntityType element can contain at most one Documentation element.
         */
        HasDocumentation;
    /**
     * @var string $name 6.1.1 The edm:Name Attribute
     *             A value of the form [simpleidentifier][csdl19] MUST be provided for the edm:Name attribute because an entity
     *             type is a nominal type. The value identifies the entity type and MUST be unique within the entity type's
     *             namespace.
     *
     * An EntityType is a schema level named element and has a unique name.
     *
     * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl6.1.1
     */
    private $name = null;

    /**
     * @var string $baseType 6.1.2 The edm:BaseType Attribute
     *             An entity type can inherit from another entity type by specifying a [singleentitytypereference][csdl19] value
     *             for the edm:BaseType attribute.
     *
     * An entity type that provides a value for the base type attribute MUST NOT declare a key with the edm:Key element.
     *
     * An entity type inherits the key as well as structural and navigation properties declared on the entity type's
     * base type.
     *
     * An entity type MUST NOT introduce an inheritance cycle via the base type attribute.
     *
     * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl6.1.2
     */
    private $baseType = null;

    /**
     * @var bool $abstract 6.1.3 The edm:Abstract Attribute
     *           An entity type MAY indicate that it cannot be instantiated by providing a [boolean][csdl19] value of true to the
     *           edm:Abstract attribute. If not specified, the abstract attribute defaults to false.
     *
     * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl6.1.3
     */
    private $abstract = false;

    /**
     * @var bool $openType 6.1.4 The edm:OpenType Attribute
     *
     * An entity type MAY indicate that it can be freely extended by providing a [boolean][csdl19] value of true to
     * the edm:OpenType attribute. An open entity type allows entity instances to add properties dynamically simply by
     * adding uniquely named values to the payload.
     *
     * If no value is provided for the open type attribute, the value of the open type attribute is set to false.
     *
     * An entity type derived from an open entity type MUST NOT provide a value of false for the open type attribute.
     *
     * In CSDL 1.2, CSDL 2.0, and CSDL 3.0, an EntityType that represents an OpenEntityType MUST have an OpenType
     * attribute that is defined with its value equal to "true".
     *
     * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl6.1.4
     */
    private $openType = false;
    /**
     * @var bool $hasStream 6.1.5 The metadata:HasStream Attribute
     *           An entity type MAY contain the metadata:hasstream attribute.
     *
     * A value of true specifies that the entity type is a media entity. Media entities are entities that represent a media stream, such as a photo. For more information on Media Entities, see [OData:Core][].
     *
     * If no value is provided for the HasStream attribute, the value of the HasStream attribute is set to false.
     * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl6.1.5
     */
    private $hasStream = false;

    /**
     * @var AccessorType $typeAccess
     */
    private $typeAccess = null;

    /**
     * @var PropertyRef[]|KeyElement $key
     */
    private $key ;

    /**
     * @var PropertyHolder|Property[] $property EntityTypeProperty child elements are uniquely named within the
     *                                inheritance hierarchy for the EntityType. Property child elements and NavigationProperty child elements
     *                                cannot have the same name as their declaring EntityType.
     */
    private $property;

    /**
     * @var NavigationPropertyHolder|NavigationProperty[] $navigationProperty
     */
    private $navigationProperty ;

    public function __construct(
        string $name,
        string $baseType = null,
        bool $isAbstract = false,
        bool $isOpenType = false,
        bool $hasStream = false,
        Documentation $documentation = null)
    {
        $this->key = new KeyElement();
        $this->property = new PropertyHolder();
        $this->navigationProperty = new NavigationPropertyHolder();
        $this
            ->setName($name)
            ->setBaseType($baseType)
            ->setAbstract($isAbstract)
            ->setOpenType($isOpenType)
            ->setHasStream($hasStream)
            ->setDocumentation($documentation);
    }

    /**
     * Gets as name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets a new name.
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name):self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as baseType.
     *
     * @return string|null
     */
    public function getBaseType() : ?string
    {
        return $this->baseType;
    }

    /**
     * Sets a new baseType.
     *
     * @param  string|null $baseType
     * @return self
     */
    public function setBaseType(?string $baseType):self
    {
        $this->baseType = $baseType;
        return $this;
    }

    /**
     * Gets as abstract.
     *
     * @return bool
     */
    public function getAbstract():bool
    {
        return $this->abstract;
    }

    /**
     * Sets a new abstract.
     *
     * @param  bool $abstract
     * @return self
     */
    public function setAbstract(bool $abstract): self
    {
        $this->abstract = $abstract;
        return $this;
    }

    /**
     * Gets as openType.
     *
     * @return bool
     */
    public function getOpenType(): bool
    {
        return $this->openType;
    }

    /**
     * Sets a new openType.
     *
     * @param  bool $openType
     * @return self
     */
    public function setOpenType(bool $openType): self
    {
        $this->openType = $openType;
        return $this;
    }
    /**
     * Gets as openType.
     *
     * @return bool
     */
    public function getHasStream(): bool
    {
        return $this->hasStream;
    }

    /**
     * Sets a new HasStream.
     *
     * @param  bool $hasStream
     * @return self
     */
    public function setHasStream(bool $hasStream): self
    {
        $this->hasStream = $hasStream;
        return $this;
    }
    /**
     * Gets as typeAccess.
     *
     * @return AccessorType
     */
    public function getTypeAccess()
    {
        return $this->typeAccess;
    }

    /**
     * Sets a new typeAccess.
     *
     * @param  AccessorType $typeAccess
     * @return self
     */
    public function setTypeAccess(AccessorType $typeAccess): self
    {
        $this->typeAccess = $typeAccess;
        return $this;
    }

    /**
     * Adds as propertyRef.
     *
     * @param PropertyRef $propertyRef
     *@return self
     */
    public function addToKey(PropertyRef $propertyRef)
    {
        $this->key[$propertyRef->getName()] = $propertyRef;
        return $this;
    }

    /**
     * isset key.
     *
     * @param  string $index
     * @return bool
     */
    public function issetKey(string $index): bool
    {
        return isset($this->key[$index]);
    }

    /**
     * unset key.
     *
     * @param  string $index
     * @return void
     */
    public function unsetKey(string $index): void
    {
        unset($this->key[$index]);
    }

    /**
     * Gets as key.
     *
     * @return PropertyRef[]|KeyElement
     */
    public function getKey(): KeyElement
    {
        return $this->key;
    }

    /**
     * Adds as property.
     *
     * @param  Property $property
     * @return self
     */
    public function addToProperty(Property $property): self
    {
        $this->property[$property->getName()] = $property;
        return $this;
    }

    /**
     * isset property.
     *
     * @param  string $index
     * @return bool
     */
    public function issetProperty(string $index): bool
    {
        return isset($this->property[$index]);
    }

    /**
     * unset property.
     *
     * @param  string $index
     * @return void
     */
    public function unsetProperty(string $index): void
    {
        unset($this->property[$index]);
    }

    /**
     * Gets as property.
     *
     * @return Property[]|PropertyHolder
     */
    public function getProperty(): PropertyHolder
    {
        return $this->property;
    }

    /**
     * Adds as navigationProperty.
     *
     * @param NavigationProperty $navigationProperty
     *@return self
     */
    public function addToNavigationProperty(NavigationProperty $navigationProperty): self
    {
        $this->navigationProperty[$navigationProperty->getName()] = $navigationProperty;
        return $this;
    }

    /**
     * isset navigationProperty.
     *
     * @param  string $index
     * @return bool
     */
    public function issetNavigationProperty(string $index): bool
    {
        return isset($this->navigationProperty[$index]);
    }

    /**
     * unset navigationProperty.
     *
     * @param  string $index
     * @return void
     */
    public function unsetNavigationProperty(string $index): void
    {
        unset($this->navigationProperty[$index]);
    }

    /**
     * Gets as navigationProperty.
     *
     * @return NavigationProperty[]|NavigationPropertyHolder
     */
    public function getNavigationProperty():NavigationPropertyHolder
    {
        return $this->navigationProperty;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'EntityType';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('metadata:HasStream', $this->getHasStream(), true),
            new AttributeContainer('Name', $this->getName()),
            new AttributeContainer('BaseType', $this->getBaseType(), true),
            new AttributeContainer('Abstract', $this->getAbstract()),
            new AttributeContainer('OpenType', $this->getOpenType()),

        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return array_merge(
            [
                $this->getDocumentation(),
                $this->getKey(),
            ],
            $this->getNavigationProperty()->__toArray(),
            $this->getProperty()->__toArray(),
            [
                $this->getTypeAnnotation(),
                $this->getValueAnnotation(),
            ]);
    }
}
