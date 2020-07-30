<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Values;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Helpers\ValueHelpers;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IStringConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;

/**
 * Represents an EDM string constant.
 *
 * @package AlgoWeb\ODataMetadata\Library\Values
 */
class EdmStringConstant extends EdmValue implements IStringConstantExpression
{
    use ValueHelpers;
    private $value;

    /**
     * Initializes a new instance of the EdmStringConstant class.
     *
     * @param string                  $value string value represented by this value
     * @param IPrimitiveTypeReference $type  type of the string
     */
    public function __construct(string $value, IPrimitiveTypeReference $type)
    {
        parent::__construct($type);
        $this->value = $value;
    }

    /**
     * @return string gets the definition of this binary value
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return ExpressionKind gets the kind of this expression
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::StringConstant();
    }

    /**
     * @return ValueKind gets the kind of this value
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::String();
    }
}
