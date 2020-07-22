<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Values;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Helpers\ValueHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDecimalConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;

/**
 * Represents an EDM decimal constant.
 *
 * @package AlgoWeb\ODataMetadata\Library\Values
 */
class EdmDecimalConstant extends EdmValue implements IDecimalConstantExpression
{
    use ValueHelpers;
    private $value;

    /**
     * Initializes a new instance of the EdmBooleanConstant class.
     *
     * @param float                   $value boolean value represented by this value
     * @param IPrimitiveTypeReference $type  type of the decimal
     */
    public function __construct(float $value, IPrimitiveTypeReference $type)
    {
        parent::__construct($type);
        $this->value = $value;
    }

    /**
     * @return float gets the definition of this binary value
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @return ExpressionKind gets the kind of this expression
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::DecimalConstant();
    }

    /**
     * @return ValueKind gets the kind of this value
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::Decimal();
    }
}
