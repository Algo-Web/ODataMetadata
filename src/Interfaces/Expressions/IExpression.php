<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;

/**
 * Interface IExpression.
 *
 * Represents an EDM expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IExpression extends IEdmElement
{
    /**
     * @return ExpressionKind gets the kind of this expression
     */
    public function getExpressionKind(): ExpressionKind;
}
