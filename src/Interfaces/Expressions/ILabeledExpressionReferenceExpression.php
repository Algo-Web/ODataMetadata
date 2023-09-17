<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

/**
 * Interface ILabeledExpressionReferenceExpression.
 *
 * Represents a reference to an EDM labeled expression.
 *
 * TODO: rename this to ILabeledElementReferenceExpression
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface ILabeledExpressionReferenceExpression extends IExpression
{
    /**
     * @return ILabeledExpression gets the referenced expression
     */
    public function getReferencedLabeledExpression(): ILabeledExpression;
}
