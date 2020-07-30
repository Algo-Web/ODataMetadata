<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\Values\IBinaryValue;

/**
 * Interface IBinaryConstantExpression.
 *
 * Represents an EDM binary constant expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IBinaryConstantExpression extends IExpression, IBinaryValue
{
    public function getValue(): array;
}
