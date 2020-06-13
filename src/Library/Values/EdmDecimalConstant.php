<?php


namespace AlgoWeb\ODataMetadata\Library\Values;


use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDecimalConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;

/**
 * Represents an EDM decimal constant.
 *
 * @package AlgoWeb\ODataMetadata\Library\Values
 */
class EdmDecimalConstant extends EdmValue implements IDecimalConstantExpression
{
    private $value;

    /**
     * Initializes a new instance of the EdmBooleanConstant class.
     *
     * @param float $value Boolean value represented by this value.
     * @param IPrimitiveTypeReference|null $type Type of the boolean.
     */
    public function __construct( float $value, ?IPrimitiveTypeReference $type = null)
    {
        parent::__construct($type);
        $this->value = $value;
    }

    /**
     * @return float Gets the definition of this binary value.
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @return ExpressionKind Gets the kind of this expression.
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::DecimalConstant();
    }

    /**
     * @return ValueKind Gets the kind of this value.
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::Decimal();
    }
}