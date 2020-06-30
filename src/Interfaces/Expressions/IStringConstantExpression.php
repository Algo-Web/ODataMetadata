<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\Values\IStringValue;

/**
 * Interface IStringConstantExpression.
 *
 * Represents an EDM string constant expression
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IStringConstantExpression extends IExpression, IStringValue
{
}
