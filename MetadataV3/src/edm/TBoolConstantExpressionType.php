<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

/**
 * Class representing TBoolConstantExpressionType
 *
 *
 * XSD Type: TBoolConstantExpression
 */
class TBoolConstantExpressionType
{

    /**
     * @property boolean $__value
     */
    private $__value = null;

    /**
     * Construct
     *
     * @param boolean $value
     */
    public function __construct($value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value
     *
     * @param boolean ...$value
     * @return boolean
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
