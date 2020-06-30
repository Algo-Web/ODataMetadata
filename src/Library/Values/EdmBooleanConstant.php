<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Values;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBooleanConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;

/**
 * Represents an EDM boolean constant.
 *
 * @package AlgoWeb\ODataMetadata\Library\Values
 */
class EdmBooleanConstant extends EdmValue implements IBooleanConstantExpression
{
    private $value;

    /**
     * Initializes a new instance of the EdmBooleanConstant class.
     *
     * @param bool                    $value boolean value represented by this value
     * @param IPrimitiveTypeReference $type  type of the boolean
     */
    public function __construct(bool $value, IPrimitiveTypeReference $type)
    {
        parent::__construct($type);
        $this->value = $value;
    }

    /**
     * @return bool gets the definition of this binary value
     */
    public function getValue(): bool
    {
        return $this->value;
    }

    /**
     * @return ExpressionKind gets the kind of this expression
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::BooleanConstant();
    }

    /**
     * @return ValueKind gets the kind of this value
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::Boolean();
    }
}
