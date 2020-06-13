<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;

/**
 * Interface IValueTermReferenceExpression
 * @package AlgoWeb\ODataMetadata\Interfaces
 */
interface IValueTermReferenceExpression extends IExpression
{
    /**
     * @return IExpression Gets the expression for the structured value containing the referenced term property.
     */
    public function getBase(): IExpression;

    /**
     * @return IValueTerm Gets the referenced value term.
     */
    public function getTerm(): IValueTerm;

    /**
     * @return string Gets the optional qualifier.
     */
    public function getQualifier(): ?string;

}