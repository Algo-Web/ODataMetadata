<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\Values\IFloatingValue;

/**
 * Interface IEdmFloatingConstantExpression.
 *
 * Represents an EDM floating constant expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IFloatingConstantExpression extends IExpression, IFloatingValue
{
}
