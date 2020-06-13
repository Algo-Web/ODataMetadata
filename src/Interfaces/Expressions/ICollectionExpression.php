<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;


use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * Interface ICollectionExpression
 *
 * Represents an EDM multi-value construction expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface ICollectionExpression extends IExpression
{
    /**
     * @return ITypeReference Gets the declared type of the collection, or null if there is no declared type.
     */
    public function getDeclaredType(): ITypeReference;

    /**
     * @return IExpression[] Gets the constructed element values.
     */
    public function getElements(): array;

}