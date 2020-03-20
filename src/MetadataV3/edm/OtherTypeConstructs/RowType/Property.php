<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\RowType;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Concerns\HasType;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;

/**
 * One or more Property elements are used to describe the structure of a RowType element.
 *
 * The following is an example of a RowType element with two Property elements.
 *
 *     <ReturnType>
 *         <CollectionType>
 *             <RowType>
 *                 <Property Name="C" Type="Customer"/>
 *                 <Property Name="Orders" Type="Collection(Order)"/>
 *             </RowType>
 *         </CollectionType>
 *     </ReturnType>
 *
 * The following is an example of a collection of RowType elements that contains a collection of RowType elements.
 *
 *     <ReturnType>
 *         <CollectionType>
 *             <RowType>
 *                 <Property Name="Customer" Type="Customer"/>
 *                 <Property Name="Orders">
 *                     <CollectionType>
 *                         <RowType>
 *                             <Property Name="OrderNo" Type="Int32"/>
 *                             <Property Name="OrderDate" Type="Date"/>
 *                         <RowType>
 *                     <CollectionType>
 *                 </Property>
 *             </RowType>
 *         </CollectionType>
 *     </ReturnType>
 *
 * The following rules apply to the Property elements of a RowType element:
 * - Property MUST have a Name attribute defined that is of type SimpleIdentifier. The Name attribute represents the
 *   name of this Property.
 * - The type of a property that belongs to a RowType MUST be one of the following:
 * - - Scalar type
 * - - EntityType
 * - - ReferenceType
 * - - RowType
 * - - CollectionType
 * - Property defines a type either as an attribute or as a child element.
 * - Property cannot contain both an attribute and a child element defining the type of the Property element.
 * - Property can define facets if the type is a scalar type.
 * - Property can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 *   attributes cannot collide.
 * - Property can contain any number of AnnotationElement elements.
 * - AnnotationElement elements are last in the sequence of child elements of Property.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl5.1
 * XSD Type: TProperty
 */
class Property extends EdmBase
{
    use HasType;
    /**
     * @var string $name
     */
    private $name = null;

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'Property';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return array_merge(
            [new AttributeContainer('Name', $this->getName(),true)],
            $this->getAttributesHasType()
        );
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return [$this->getChildElementsHasType()];
    }
}

