<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasAnnotations;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\HasDocumentation;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityType\PropertyHolder;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\INominalType;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * 2.1.7 ComplexType.
 *
 * A ComplexType element represents a set of related information. Like an EntityType element, a ComplexType element
 * consists of one or more properties of scalar type or complex type. However, unlike an EntityType element, a
 * ComplexType element cannot have an entity Key element or any NavigationProperty elements. ComplexType can be
 * categorized as an EDM type.
 *
 * A ComplexType element provides a mechanism to create declared properties with a rich (structured) payload. Its
 * definition includes its name and payload. The payload of a ComplexType is very similar to that of an EntityType.
 *
 * The following is an example of the ComplexType element.
 *
 *     <ComplexType Name="CAddress">
 *         <Documentation>
 *             <Summary>This complextype describes the concept of an Address</Summary>
 *             <LongDescription>This complextype describes the concept of an Address for use with Customer and other Entities</LongDescription>
 *         </Documentation>
 *         <Property Name="StreetAddress" Type="String">
 *             <Documentation>
 *                 <LongDescription>StreetAddress contains the string describing the address of the street associated with an address</LongDescription>
 *             </Documentation>
 *         </Property>
 *         <Property Name="City" Type="String" />
 *         <Property Name="Region" Type="String" />
 *         <Property Name="PostalCode" Type="String" />
 *     </ComplexType>
 *
 * The following rules apply to the ComplexType element:
 * - A ComplexType MUST have a Name attribute defined. Name is of type SimpleIdentifier and represents the name of this
 *   ComplexType.
 * - ComplexType is a schema level named element and has a unique name.
 * - In CSDL 1.1, CSDL 1.2, CSDL 2.0, and CSDL 3.0, a ComplexType can derive from a BaseType. BaseType is either the
 *   namespace qualified name or alias qualified name of another ComplexType that is in scope.
 * - A ComplexType cannot introduce an inheritance cycle via the BaseType attribute.
 * - In CSDL 1.1, CSDL 1.2, CSDL 2.0, and CSDL 3.0, ComplexType can have its Abstract attribute set to "true". By
 *   default, Abstract is set to "false".
 * - A ComplexType can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 *   attributes cannot collide.
 * - A ComplexType element can contain a maximum of one Documentation element.
 * - A ComplexType can have any number of Property elements.
 * - In CSDL 1.1, CSDL 1.2, CSDL 2.0, and CSDL 3.0, the property names of a ComplexType MUST be uniquely named within
 *   the inheritance hierarchy for the ComplexType. ComplexType properties MUST NOT have the same name as their
 *   declaring ComplexType or any of its base types.
 * - ComplexType can contain any number of AnnotationElement elements.
 * - Child elements of ComplexType are to appear in this sequence: Documentation, Property, AnnotationElement.
 * - In CSDL 3.0, ComplexType can contain any number of TypeAnnotation elements.
 * - In CSDL 3.0, ComplexType can contain any number of ValueAnnotation elements.
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl7
 * XSD Type: TComplexType
 */
class ComplexType extends EdmBase implements INominalType
{
    use HasDocumentation,
        HasAnnotations;
    /**
     * @var string $name A ComplexType MUST have a Name attribute defined. Name is of type SimpleIdentifier and
     *             represents the name of this ComplexType.
     *             ComplexType is a schema level named element and has a unique name.
     */
    private $name;

    /**
     * @var PropertyHolder|Property[] $property
     */
    private $property = [

    ];
    public function __construct(string $name, array $property = [], Documentation $documentation = null)
    {
        $this
            ->setName($name)
            ->setProperty($property)
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
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Adds as property.
     *
     * @param  Property $property
     * @return self
     */
    public function addToProperty(Property $property)
    {
        $this->property[] = $property;
        return $this;
    }

    /**
     * isset property.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetProperty($index)
    {
        return isset($this->property[$index]);
    }

    /**
     * unset property.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetProperty($index)
    {
        unset($this->property[$index]);
    }

    /**
     * Gets as property.
     *
     * @return PropertyHolder|Property[]
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Sets a new property.
     *
     * @param  PropertyHolder|Property[] $property
     * @return self
     */
    public function setProperty(array $property)
    {
        $this->property = $property;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'ComplexType ';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [
            new AttributeContainer('Name', $this->getName())
        ];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return array_merge(
            [$this->getDocumentation()],
            $this->getProperty(),
            $this->getTypeAnnotation(),
            $this->getValueAnnotation()
        );
    }

    public function isAttribute(): bool
    {
        return false;
    }
}
