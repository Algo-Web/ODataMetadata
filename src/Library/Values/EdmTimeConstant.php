<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Values;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Helpers\ValueHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ITimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use DateTime;

class EdmTimeConstant extends EdmValue implements ITimeConstantExpression
{
    use ValueHelpers;
    private $value;

    /**
     * Initializes a new instance of the EdmTimeConstant class.
     *
     * @param DateTime               $value time value represented by this value
     * @param ITemporalTypeReference $type  type of the Time
     */
    public function __construct(DateTime $value, ITemporalTypeReference $type)
    {
        parent::__construct($type);
        $this->value = $value;
    }

    /**
     * @return DateTime gets the definition of this binary value
     */
    public function getValue(): DateTime
    {
        return $this->value;
    }

    /**
     * @return ExpressionKind gets the kind of this expression
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::TimeConstant();
    }

    /**
     * @return ValueKind gets the kind of this value
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::Time();
    }
}
