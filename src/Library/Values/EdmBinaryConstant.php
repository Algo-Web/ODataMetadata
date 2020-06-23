<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Library\Values;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IBinaryConstantExpression;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;

/**
 * Represents an EDM binary constant.
 *
 * @package AlgoWeb\ODataMetadata\Library\Values
 */
class EdmBinaryConstant extends EdmValue implements IBinaryConstantExpression
{
    private $value;

    /**
     * Initializes a new instance of the EdmBinaryConstant class.
     *
     * @param string[]                  $value
     * @param IBinaryTypeReference      $type
     */
    public function __construct(array $value, IBinaryTypeReference $type)
    {
        parent::__construct($type);
        $this->value = $value;
    }

    /**
     * @return string[] gets the definition of this binary value
     */
    public function getValue(): array
    {
        return $this->value;
    }

    /**
     * @return ExpressionKind gets the kind of this expression
     */
    public function getExpressionKind(): ExpressionKind
    {
        return ExpressionKind::BinaryConstant();
    }

    /**
     * @return ValueKind gets the kind of this value
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::Binary();
    }
}
