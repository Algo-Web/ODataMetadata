<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityType;

use AlgoWeb\ODataMetadata\MetadataV3\DomBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\PropertyRef;
use AlgoWeb\ODataMetadata\Writer\AttributeContainer;
use DOMElement;

/**
 * 2.1.5 Entity Key.
 *
 * A Key element describes which Property elements form a key that can uniquely identify instances of an EntityType.
 * Any set of non-nullable, immutable, scalar type declared properties can serve as the key.
 *
 * The following is an example of the Key element.
 *
 *     <Key>
 *         <PropertyRef Name="CustomerId" />
 *     </Key>
 *
 * The following rules apply to the Key element:
 * - Key can contain any number of AnnotationAttribute attributes. The full names of the AnnotationAttribute attributes
 *   cannot collide.
 * - Key MUST have one or more PropertyRef child elements.
 * - Each PropertyRef child element names a Property of a type that is equality comparable.
 * - In CSDL 2.0 and CSDL 3.0, Key can contain any number of AnnotationElement elements.
 *
 * @see https://www.odata.org/documentation/odata-version-3-0/common-schema-definition-language-csdl/#csdl6.2
 *
 * XSD Type: TEntityKeyElement
 */
class KeyElement extends EdmBase implements \ArrayAccess
{
    /**
     * @var PropertyRef[]
     */
    private $propertyReferences = [];

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->propertyReferences);
    }


    public function offsetGet($offset): PropertyRef
    {
        $this->propertyReferences[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        if (!$value instanceof PropertyRef) {
            throw new \InvalidArgumentException(sprintf('all keys must be a %s', PropertyRef::class));
        }
        if (null === $offset) {
            $this->propertyReferences[] = $value;
        } else {
            $this->propertyReferences[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->propertyReferences[$offset]);
    }

    /**
     * @return string
     */
    public function getDomName(): string
    {
        return 'Key';
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
        return $this->propertyReferences;
    }
}
