<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\IProperty;

/**
 * Interface IPropertyReferenceExpression
 *
 * Represents an EDM property reference expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IPropertyReferenceExpression extends IExpression
{
    /**
     * @return IExpression Gets the expression for the structured value containing the referenced property.
     */
    public function getBase(): IExpression;

    /**
     * @return IProperty Gets the referenced property.
     */
    public function getReferencedProperty(): IProperty;

}