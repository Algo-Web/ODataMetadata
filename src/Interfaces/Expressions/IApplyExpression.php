<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

/**
 * Interface IApplyExpression.
 *
 * Represents an EDM function application expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IApplyExpression extends IExpression
{
    /**
     * @return IExpression|null gets the applied function
     */
    public function getAppliedFunction(): ?IExpression;

    /**
     * @return IExpression[] gets the arguments to the function
     */
    public function getArguments(): array;
}
