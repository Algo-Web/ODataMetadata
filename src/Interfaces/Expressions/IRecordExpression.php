<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\Expressions\RecordExpression\IPropertyConstructor;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredTypeReference;

/**
 * Interface IRecordExpression.
 *
 * Represents an EDM record construction expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IRecordExpression extends IExpression
{
    /**
     * @return IStructuredTypeReference gets the declared type of the record, or null if there is no declared type
     */
    public function getDeclaredType(): ?IStructuredTypeReference;

    /**
     * @return IPropertyConstructor[] gets the constructed property values
     */
    public function getProperties(): array;
}
