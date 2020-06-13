<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;


use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;

/**
 * Interface IParameterReferenceExpression
 *
 * Represents an EDM parameter reference expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IParameterReferenceExpression extends IExpression
{
    /**
     *
     *
     * @return IFunctionParameter Gets the referenced parameter.
     */
    public function getReferencedParameter(): IFunctionParameter;
}