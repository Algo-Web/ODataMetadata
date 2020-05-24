<?php


declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\EntityType;


class NavigationPropertyHolder implements \ArrayAccess
{
    /**
     * @var NavigationProperty[]
     */
    private $property = [];

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->property);
    }


    public function offsetGet($offset):NavigationProperty
    {
        $this->property[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        if (!$value instanceof NavigationProperty) {
            throw new \InvalidArgumentException(sprintf('all keys must be a %s', NavigationProperty::class));
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

    public function __toArray(){
        return $this->property;
    }
}