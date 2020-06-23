<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Values;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IDateTimeConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use DateTime;

/**
 * Represents an EDM datetime constant.
 * @package AlgoWeb\ODataMetadata\Library\Values
 */
class EdmDateTimeConstant extends EdmValue implements IDateTimeConstantExpression
{
    private $value;

    /**
     * Initializes a new instance of the EdmDateTimeConstant class.
     *
     * @param DateTime                    $value dateTime value represented by this value
     * @param ITemporalTypeReference      $type  type of the DateTime
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
        return ExpressionKind::DateTimeConstant();
    }

    /**
     * @return ValueKind gets the kind of this value
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::DateTime();
    }
}
