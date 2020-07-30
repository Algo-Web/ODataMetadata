<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\INamedElement;

/**
 * Interface ILabeledExpression.
 *
 * Represents an EDM labeled expression element.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface ILabeledExpression extends INamedElement, IExpression
{
    /**
     * @return IExpression gets the underlying expression
     */
    public function getExpression(): IExpression;
}
