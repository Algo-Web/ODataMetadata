<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\Values\INullValue;

/**
 * Interface INullExpression.
 *
 * Represents an EDM null expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface INullExpression extends IExpression, INullValue
{
}
