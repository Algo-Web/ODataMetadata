<?php


namespace AlgoWeb\ODataMetadata\Library\Values;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IIntegerConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;

/**
 * Represents an EDM integer constant.
 *
 * @package AlgoWeb\ODataMetadata\Library\Values
 */
class EdmIntegerConstant extends EdmValue implements IIntegerConstantExpression
{
    private $value;

    /**
     * Initializes a new instance of the EdmGuidConstant class.
     *
     * @param int $value String value represented by this value.
     * @param IPrimitiveTypeReference|null $type Type of the boolean.
     */
    public function __construct( int $value, ?IPrimitiveTypeReference $type = null)
    {
        parent::__construct($type);
        $this->value = $value;
    }

    /**
     *
     *
     * @return int Gets the definition of this binary value.
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return ExpressionKind Gets the kind of this expression.
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::IntegerConstant();
    }

    /**
     * @return ValueKind Gets the kind of this value.
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::Integer();
    }
}