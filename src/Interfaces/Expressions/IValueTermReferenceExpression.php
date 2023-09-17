<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;

/**
 * Interface IValueTermReferenceExpression.
 * @package AlgoWeb\ODataMetadata\Interfaces
 */
interface IValueTermReferenceExpression extends IExpression
{
    /**
     * @return IExpression gets the expression for the structured value containing the referenced term property
     */
    public function getBase(): IExpression;

    /**
     * @return IValueTerm gets the referenced value term
     */
    public function getTerm(): IValueTerm;

    /**
     * @return string gets the optional qualifier
     */
    public function getQualifier(): ?string;
}
