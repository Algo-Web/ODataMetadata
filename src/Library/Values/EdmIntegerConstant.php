<?php

declare(strict_types=1);


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
     * @param int                          $value string value represented by this value
     * @param IPrimitiveTypeReference|null $type  type of the boolean
     */
    public function __construct(int $value, ?IPrimitiveTypeReference $type = null)
    {
        parent::__construct($type);
        $this->value = $value;
    }

    /**
     * @return int gets the definition of this binary value
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return ExpressionKind gets the kind of this expression
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::IntegerConstant();
    }

    /**
     * @return ValueKind gets the kind of this value
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::Integer();
    }
}
