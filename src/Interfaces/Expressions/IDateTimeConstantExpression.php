<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\Values\IDateTimeValue;

/**
 * Interface IDateTimeConstantExpression.
 *
 *  Represents an EDM datetime constant expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IDateTimeConstantExpression extends IExpression, IDateTimeValue
{
}
