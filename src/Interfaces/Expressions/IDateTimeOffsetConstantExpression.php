<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\Values\IDateTimeOffsetValue;

/**
 * Interface IDateTimeOffsetConstantExpression.
 *
 * Represents an EDM datetime with offset constant expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IDateTimeOffsetConstantExpression extends IExpression, IDateTimeOffsetValue
{
}
