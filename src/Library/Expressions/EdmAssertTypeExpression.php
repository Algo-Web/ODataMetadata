<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Expressions;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IAssertTypeExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Library\EdmElement;

/**
 * Represents an EDM type assertion expression.
 *
 * @package AlgoWeb\ODataMetadata\Library\Expressions
 */
class EdmAssertTypeExpression extends EdmElement implements IAssertTypeExpression
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
     * Initializes a new instance of the EdmAssertTypeExpression class.
     * @param IExpression    $operand expression for which the type is asserted
     * @param ITypeReference $type    type to assert
     */
    public function __construct(IExpression $operand, ITypeReference $type)
    {
        $this->operand = $operand;
        $this->type    = $type;
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

    /**
     * {@inheritdoc}
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::AssertType();
    }
}
