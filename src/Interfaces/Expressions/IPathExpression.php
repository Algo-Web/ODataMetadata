<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Expressions;


/**
 * Interface IPathExpression
 *
 * Represents an EDM path expression.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Expressions
 */
interface IPathExpression extends IExpression
{
    /**
     * @return string[]  Gets the path as a decomposed qualified name. "A.B/C/D.E" is { "A.B", "C", "D.E" }.
     */
    public function getPath(): array;

}