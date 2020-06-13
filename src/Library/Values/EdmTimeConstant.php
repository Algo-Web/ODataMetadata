<?php


namespace AlgoWeb\ODataMetadata\Library\Values;


use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ITimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use DateTime;

class EdmTimeConstant extends EdmValue implements ITimeConstantExpression
{
    private $value;

    /**
     * Initializes a new instance of the EdmTimeConstant class.
     *
     * @param DateTime $value Time value represented by this value.
     * @param ITemporalTypeReference|null $type Type of the Time.
     */
    public function __construct(DateTime $value, ?ITemporalTypeReference $type = null)
    {
        parent::__construct($type);
        $this->value = $value;
    }

    /**
     *
     *
     * @return DateTime Gets the definition of this binary value.
     */
    public function getValue(): DateTime
    {
        return $this->value;
    }

    /**
     * @return ExpressionKind Gets the kind of this expression.
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::DateTimeConstant();
    }

    /**
     * @return ValueKind Gets the kind of this value.
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::DateTime();
    }
}