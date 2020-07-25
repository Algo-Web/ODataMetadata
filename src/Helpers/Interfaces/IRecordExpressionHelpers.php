<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;

use AlgoWeb\ODataMetadata\Interfaces\Expressions\RecordExpression\IPropertyConstructor;

/**
 * Trait RecordExpressionHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IRecordExpressionHelpers
{
    /**
     * Finds a property of a record expression.
     *
     * @param  string                    $propertyName name of the property to find
     * @return IPropertyConstructor|null the property, if found, otherwise null
     */
    public function findProperty(string $propertyName): ?IPropertyConstructor;
}
