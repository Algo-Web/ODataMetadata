<?php


namespace AlgoWeb\ODataMetadata\Library\Values;


use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IStringConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;

/**
 * Represents an EDM string constant.
 *
 * @package AlgoWeb\ODataMetadata\Library\Values
 */
class EdmStringConstant extends EdmValue implements IStringConstantExpression
{
    private $value;

    /**
     * Initializes a new instance of the EdmStringConstant class.
     *
     * @param string $value String value represented by this value.
     * @param IPrimitiveTypeReference|null $type Type of the boolean.
     */
    public function __construct( string $value, ?IPrimitiveTypeReference $type = null)
    {
        parent::__construct($type);
        $this->value = $value;
    }

    /**
     *
     *
     * @return string Gets the definition of this binary value.
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return ExpressionKind Gets the kind of this expression.
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::StringConstant();
    }

    /**
     * @return ValueKind Gets the kind of this value.
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::String();
    }
}