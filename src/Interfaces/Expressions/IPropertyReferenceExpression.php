<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\IProperty;

/**
 * Interface IPropertyReferenceExpression.
 *
 * Represents an EDM property reference expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IPropertyReferenceExpression extends IExpression
{
    /**
     * @return IExpression|null gets the expression for the structured value containing the referenced property
     */
    public function getBase(): ?IExpression;

    /**
     * @return IProperty gets the referenced property
     */
    public function getReferencedProperty(): IProperty;
}
