<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GExpressionTrait;

/**
 * Class representing TPropertyReferenceExpressionType
 *
 *
 * XSD Type: TPropertyReferenceExpression
 */
class TPropertyReferenceExpressionType extends IsOK
{
    use GExpressionTrait;
    /**
     * @property string $property
     */
    private $property = null;

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
        if (!$this->isGExpressionValid($msg)) {
            return false;
        }
        return true;
    }
}
