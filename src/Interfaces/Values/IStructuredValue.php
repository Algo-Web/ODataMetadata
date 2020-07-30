<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Values;

/**
 * Interface IStructuredValue.
 *
 * Represents an EDM structured value.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Values
 */
interface IStructuredValue extends IValue
{
    /**
     * @return IPropertyValue[] gets the property values of this structured value
     */
    public function getPropertyValues(): array;

    /**
     * Finds the value corresponding to the provided property name.
     *
     * @param  string              $propertyName property to find the value of
     * @return IPropertyValue|null The found property, or null if no property was found
     */
    public function findPropertyValues(string $propertyName): ?IPropertyValue;
}
