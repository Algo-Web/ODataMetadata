<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\Expressions\RecordExpression\IPropertyConstructor;

/**
 * Trait RecordExpressionHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait RecordExpressionHelpers
{
    /**
     * Finds a property of a record expression.
     *
     * @param  string                    $propertyName name of the property to find
     * @return IPropertyConstructor|null the property, if found, otherwise null
     */
    public function FindProperty(string $propertyName): ?IPropertyConstructor
    {
        foreach ($this->getProperties() as $propertyConstructor) {
            if ($propertyConstructor->getName() === $propertyName) {
                return $propertyConstructor;
            }
        }
        return null;
    }
    /**
     * @return IPropertyConstructor[] gets the constructed property values
     */
    abstract public function getProperties(): array;
}
