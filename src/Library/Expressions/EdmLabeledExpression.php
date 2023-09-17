<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Expressions;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ILabeledExpression;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM labeled expression.
 * @package AlgoWeb\ODataMetadata\Library\Expressions
 */
class EdmLabeledExpression extends EdmElement implements ILabeledExpression
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var IExpression
     */
    private $expression;

    /**
     * Initializes a new instance of the EdmLabeledExpression class.
     * @param string      $name       label of the expression
     * @param IExpression $expression underlying expression
     */
    public function __construct(string $name, IExpression $expression)
    {
        $this->name       = $name;
        $this->expression = $expression;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::Labeled();
    }

    /**
     * {@inheritdoc}
     */
    public function getExpression(): IExpression
    {
        return $this->expression;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }
}
