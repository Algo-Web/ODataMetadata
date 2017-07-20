<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TIntConstantExpressionType.
 *
 * XSD Type: TIntConstantExpression
 */
class TIntConstantExpressionType extends IsOK
{

    /**
     * @property int $__value
     */
    private $__value = null;

    /**
     * Construct.
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value.
     *
     * @param  int   ...$value
     * @param  int[] $value
     * @return int
     */
    public function value(...$value)
    {
        if (0 < count($value)) {
            $this->__value = $value[0];
        }
        return $this->__value;
    }

    /**
     * Gets a string value.
     *
     * @return string
     */
    public function __toString()
    {
        return strval($this->__value);
    }
}
