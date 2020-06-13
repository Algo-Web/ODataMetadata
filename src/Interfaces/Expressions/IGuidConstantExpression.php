<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;

use AlgoWeb\ODataMetadata\Interfaces\Values\IGuidValue;

/**
 * Class IGuidConstantExpression
 *
 * Represents an EDM guid constant expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IGuidConstantExpression extends IExpression, IGuidValue
{

}