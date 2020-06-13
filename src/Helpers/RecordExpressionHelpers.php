<?php


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\Expressions\IRecordExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\RecordExpression\IPropertyConstructor;

/**
 * Trait RecordExpressionHelpers
 * @package AlgoWeb\ODataMetadata\Helpers
 * @mixin IRecordExpression
 */
trait RecordExpressionHelpers
{
    /**
     * Finds a property of a record expression.
     *
     * @param string $propertyName Name of the property to find.
     * @return IPropertyConstructor|null The property, if found, otherwise null.
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
}