<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\RowType\Property;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use ArrayAccess;
use InvalidArgumentException;

/**
 * 2.1.28 RowType
 *
 * A RowType is an unnamed structure. RowType is always declared inline.
 *
 * The following is an example of a RowType in a parameter.
 *
 * <Parameter Name="Coordinate" Mode="In">
 * <RowType>
 * <Property Name="X" Type="int" Nullable="false"/>
 * <Property Name="Y" Type="int" Nullable="false"/>
 * <Property Name="Z" Type="int" Nullable="false"/>
 * </RowType>
 * </Parameter>
 *
 * The following is an example of a RowType defined in a return type.
 *
 * <ReturnType>
 * <CollectionType>
 * <RowType>
 * <Property Name="X" Type="int" Nullable="false"/>
 * <Property Name="Y" Type="int" Nullable="false"/>
 * <Property Name="Z" Type="int" Nullable="false"/>
 * </RowType>
 * </CollectionType>
 * </ReturnType>
 *
 * The following rules apply to the RowType element:
 * - RowType can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute
 *   attributes cannot collide.
 * - RowType MUST contain at least one Property element.
 * - RowType can contain more than one Property element.
 * - RowType can contain any number of AnnotationElement elements.
 * - AnnotationElement elements is last in the sequence of child elements of RowType.
 *
 * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl9.4
 * XSD Type: TRowType
 */
class RowType extends EdmBase implements ArrayAccess, IStructuralTypes
{
    /**
     * @var array|Property[] $propertyTypes 9.4.1 The edm:RowType Element
     * The edm:RowType element represents a structural type without a name. The row type MUST declare one or
     * more edm:Property elements that define its structure.
     * @link https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl9.4.1
     */
    private $propertyTypes = [];

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->propertyTypes);
    }

    public function offsetGet($offset): Property
    {
        return $this->propertyTypes[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if (!$value instanceof Property) {
            throw new InvalidArgumentException(sprintf('All Enteries in RowType must be %s', Property::class));
        }
        if (null === $offset) {
            $this->propertyTypes[] = $value;
        } else {
            $this->propertyTypes[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->propertyTypes[$offset]);
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'RowType';
    }

    /**
     * @return array|AttributeContainer[]
     */
    public function getAttributes(): array
    {
        return [];
    }

    /**
     * @return array|DomBase[]
     */
    public function getChildElements(): array
    {
        return $this->propertyTypes;
    }

    public function isAttribute(): bool
    {
        return false;
    }
}
