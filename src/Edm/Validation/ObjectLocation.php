<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation;

use AlgoWeb\ODataMetadata\Interfaces\ILocation;

/**
 * Class ObjectLocation.
 * @package AlgoWeb\ODataMetadata\Validation
 */
class ObjectLocation implements ILocation
{
    private $object;

    /**
     * @return string A string representation of the location
     */
    public function __toString(): string
    {
        return strval($this->object);
    }

    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * @return mixed gets the object
     */
    public function getObject()
    {
        return $this->object;
    }
}
