<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Expressions;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIfExpression;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM if expression.
 *
 * @package AlgoWeb\ODataMetadata\Library\Expressions
 */
class EdmIfExpression extends EdmElement implements IIfExpression
{
    /**
     * @var IExpression
     */
    private $testExpression;
    /**
     * @var IExpression
     */
    private $trueExpression;
    /**
     * @var IExpression
     */
    private $falseExpression;

    /**
     * Initializes a new instance of the EdmIfExpression class.
     * @param IExpression $testExpression  Test expression
     * @param IExpression $trueExpression  expression to evaluate if testExpression evaluates to true
     * @param IExpression $falseExpression expression to evaluate if testExpression evaluates to false
     */
    public function __construct(IExpression $testExpression, IExpression $trueExpression, IExpression $falseExpression)
    {
        $this->testExpression  = $testExpression;
        $this->trueExpression  = $trueExpression;
        $this->falseExpression = $falseExpression;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::If();
    }

    /**
     * {@inheritdoc}
     */
    public function getTestExpression(): IExpression
    {
        return $this->testExpression;
    }

    /**
     * {@inheritdoc}
     */
    public function getTrueExpression(): IExpression
    {
        return $this->trueExpression;
    }

    /**
     * {@inheritdoc}
     */
    public function getFalseExpression(): IExpression
    {
        return $this->falseExpression;
    }
}
