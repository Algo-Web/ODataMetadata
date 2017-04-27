<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

/**
 * Class representing TDateTimeOffsetConstantExpressionType
 *
 *
 * XSD Type: TDateTimeOffsetConstantExpression
 */
class TDateTimeOffsetConstantExpressionType
{

    /**
     * @property \DateTime $__value
     */
    private $__value = null;

    /**
     * Construct
     *
     * @param \DateTime $value
     */
    public function __construct(\DateTime $value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value
     *
     * @param \DateTime ...$value
     * @return \DateTime
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
