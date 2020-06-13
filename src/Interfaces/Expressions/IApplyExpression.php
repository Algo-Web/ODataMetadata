<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

/**
 * Interface IApplyExpression
 *
 * Represents an EDM function application expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IApplyExpression extends IExpression
{
    /**
     * @return IExpression Gets the applied function.
     */
    public function getAppliedFunction(): IExpression;

    /**
     * @return IExpression[] Gets the arguments to the function.
     */
    public function getArguments(): array;
}