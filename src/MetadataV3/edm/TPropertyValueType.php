<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GExpressionTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GInlineExpressionsTrait;

/**
 * Class representing TPropertyValueType
 *
 *
 * XSD Type: TPropertyValue
 */
class TPropertyValueType extends IsOK
{
    use GInlineExpressionsTrait, GExpressionTrait;
    /**
     * @property string $property
     */
    private $property = null;

    public function __construct()
    {
        $this->gExpressionMaximum = 1;
        $this->gExpressionMinimum = 1;
    }
    
    /**
     * Gets as property
     *
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Sets a new property
     *
     * @param string $property
     * @return self
     */
    public function setProperty($property)
    {
        $this->property = $property;
        return $this;
    }
    
    public function isOK(&$msg = null)
    {
        if (!$this->isGInlineExpressionsValid($msg)) {
            return false;
        }
        if (!$this->isGExpressionValid($msg)) {
            return false;
        }

        return true;
    }
}
