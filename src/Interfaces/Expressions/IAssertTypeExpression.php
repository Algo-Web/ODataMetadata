<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * Interface IAssertTypeExpression.
 *
 * Represents an EDM type assertion expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IAssertTypeExpression extends IExpression
{
    /**
     * @return IExpression gets the expression for which the type is asserted
     */
    public function getOperand(): IExpression;

    /**
     * @return ITypeReference gets the asserted type
     */
    public function getType(): ITypeReference;
}
