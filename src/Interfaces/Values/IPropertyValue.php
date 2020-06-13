<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Values;

/**
 * Interface IPropertyValue
 *
 * Represents a value of an EDM property.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IPropertyValue extends IDelayedValue
{
    /**
     * @return string Gets the name of the property this value is associated with.
     */
    public function getName(): string;
}