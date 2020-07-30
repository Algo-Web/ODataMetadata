<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\Values\IDecimalValue;

/**
 * Interface IDecimalConstantExpression.
 *
 * Represents an EDM decimal constant expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IDecimalConstantExpression extends IExpression, IDecimalValue
{
}
