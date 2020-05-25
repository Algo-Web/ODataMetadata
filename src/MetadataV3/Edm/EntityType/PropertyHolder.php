<?php


declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityType;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\EdmBase;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Property;
use DOMElement;

class PropertyHolder implements \ArrayAccess
{
    /**
     * @var Property[]
     */
    private $property = [];

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->property);
    }

    public function offsetGet($offset):Property
    {
        $this->property[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        if (!$value instanceof Property) {
            throw new \InvalidArgumentException(sprintf('all keys must be a %s', Property::class));
        }
        if (null === $offset) {
            $this->property[] = $value;
        } else {
            $this->property[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->property[$offset]);
    }

    public function __toArray(): array
    {
        return $this->property;
    }
}
