<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Expressions;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IPathExpression;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM path expression.
 *
 * @package AlgoWeb\ODataMetadata\Library\Expressions
 */
class EdmPathExpression extends EdmElement implements IPathExpression
{
    /**
     * @var string[]
     */
    private $path;

    /**
     * EdmPathExpression constructor.
     * @param string[] ...$path Path string containing segments seperated by '/'. For example: "A.B/C/D.E/Func1(NS.T,NS.T2)/P1". OR Path segments array
     */
    public function __construct(string ...$path)
    {
        if (count($path) === 1) {
            $path = explode('/', $path[0]);
        }
        $this->path = $path;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::Path();
    }

    /**
     * {@inheritdoc}
     */
    public function getPath(): array
    {
        return $this->path;
    }
}
