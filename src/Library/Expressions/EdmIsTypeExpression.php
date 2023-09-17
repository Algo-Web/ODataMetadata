<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Expressions;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIsTypeExpression;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM type test expression.
 *
 * @package AlgoWeb\ODataMetadata\Library\Expressions
 */
class EdmIsTypeExpression extends EdmElement implements IIsTypeExpression
{
    /**
     * @var IExpression
     */
    private $operand;
    /**
     * @var ITypeReference
     */
    private $type;

    /**
     * Initializes a new instance of the EdmIsTypeExpression class.
     * @param IExpression    $operand expression whose type is to be tested
     * @param ITypeReference $type    type to test
     */
    public function __construct(IExpression $operand, ITypeReference $type)
    {
        $this->operand = $operand;
        $this->type    = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::IsType();
    }

    /**
     * {@inheritdoc}
     */
    public function getOperand(): IExpression
    {
        return $this->operand;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): ITypeReference
    {
        return $this->type;
    }
}
