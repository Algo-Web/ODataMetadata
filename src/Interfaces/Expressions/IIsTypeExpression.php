<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;


use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * Interface IIsTypeExpression
 *
 * Represents an EDM type test expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IIsTypeExpression extends IExpression
{
    /**
     * @return IExpression Gets the expression whose type is to be tested.
     */
    public function getOperand(): IExpression;

    /**
     * @return ITypeReference Gets the type to be tested against.
     */
    public function getType(): ITypeReference;
}