<?php

namespace MetadataV3\edm;

/**
 * Class representing TEnumConstantExpressionType
 *
 *
 * XSD Type: TEnumConstantExpression
 */
class TEnumConstantExpressionType
{

    /**
     * @property string $__value
     */
    private $__value = null;

    /**
     * Construct
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value
     *
     * @param string ...$value
     * @return string
     */
    public function value(...$value)
    {
        if(0 < count($value)){
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

