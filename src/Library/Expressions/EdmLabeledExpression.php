<?php


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
     * @param string $name Label of the expression.
     * @param IExpression $expression Underlying expression.
     */
    public function __construct(string $name, IExpression $expression)
    {
        $this->name = $name;
        $this->expression = $expression;
    }

    /**
     * @inheritDoc
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::Labeled();
    }

    /**
     * @inheritDoc
     */
    public function getExpression(): IExpression
    {
        return $this->expression;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }
}