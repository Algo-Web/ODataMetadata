<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\IFunction;

/**
 * Interface IFunctionReferenceExpression.
 *
 * Represents an EDM function reference expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IFunctionReferenceExpression extends IExpression
{
    /**
     * @return IFunction|null gets the referenced function
     */
    public function getReferencedFunction(): ?IFunction;
}
