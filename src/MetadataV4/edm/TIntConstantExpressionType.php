<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TIntConstantExpressionType
 *
 * XSD Type: TIntConstantExpression
 */
class TIntConstantExpressionType extends IsOK
{

    /**
     * @property integer $__value
     */
    private $__value = null;

    /**
     * Construct
     *
     * @param integer $value
     */
    public function __construct($value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value
     *
     * @param  integer ...$value
     * @param integer[] $value
     * @return integer
     */
    public function value(...$value)
    {
        if (0 < count($value)) {
            $this->__value = $value[0];
        }
        return $this->__value;
    }

    /**
     * Gets a string value
     *
     * @return string
     */
    public function __toString()
    {
        return strval($this->__value);
    }
}
