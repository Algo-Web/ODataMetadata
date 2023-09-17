<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Internal\Ambiguous;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpression;
use AlgoWeb\ODataMetadata\Library\Values\EdmNullExpression;

/**
 * Represents a labeled expression binding to more than one item.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal
 */
class AmbiguousLabeledExpressionBinding extends AmbiguousBinding implements ILabeledExpression
{
    /**
     * Gets the kind of this expression.
     *
     * @return ExpressionKind
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::Labeled();
    }

    /**
     * Gets the underlying expression.
     *
     * @return IExpression
     */
    public function getExpression(): IExpression
    {
        return EdmNullExpression::getInstance();
    }
}
