<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * Interface ICollectionExpression.
 *
 * Represents an EDM multi-value construction expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface ICollectionExpression extends IExpression
{
    /**
     * @return ITypeReference|null gets the declared type of the collection, or null if there is no declared type
     */
    public function getDeclaredType(): ?ITypeReference;

    /**
     * @return IExpression[] gets the constructed element values
     */
    public function getElements(): array;
}
