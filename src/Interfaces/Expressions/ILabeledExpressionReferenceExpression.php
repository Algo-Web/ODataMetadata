<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

/**
 * Interface ILabeledExpressionReferenceExpression
 *
 * Represents a reference to an EDM labeled expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface ILabeledExpressionReferenceExpression extends IExpression
{
    /**
     * @return ILabeledExpression Gets the referenced expression.
     */
    public function getReferencedLabeledExpression(): ILabeledExpression;
}