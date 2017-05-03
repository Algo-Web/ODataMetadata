<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GInlineExpressionsTrait;

/**
 * Class representing TTypeAnnotationType
 *
 *
 * XSD Type: TTypeAnnotation
 */
class TTypeAnnotationType extends IsOK
{
    use GInlineExpressionsTrait;
    /**
     * @property string $term
     */
    private $term = null;

    /**
     * @property string $qualifier
     */
    private $qualifier = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyValueType[] $propertyValue
     */
    private $propertyValue = [];

    /**
     * Gets as term
     *
     * @return string
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * Sets a new term
     *
     * @param string $term
     * @return self
     */
    public function setTerm($term)
    {
        $this->term = $term;
        return $this;
    }

    /**
     * Gets as qualifier
     *
     * @return string
     */
    public function getQualifier()
    {
        return $this->qualifier;
    }

    /**
     * Sets a new qualifier
     *
     * @param string $qualifier
     * @return self
     */
    public function setQualifier($qualifier)
    {
        $this->qualifier = $qualifier;
        return $this;
    }

    /**
     * Adds as propertyValue
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyValueType $propertyValue
     */
    public function addToPropertyValue(TPropertyValueType $propertyValue)
    {
        $this->propertyValue[] = $propertyValue;
        return $this;
    }

    /**
     * isset propertyValue
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetPropertyValue($index)
    {
        return isset($this->propertyValue[$index]);
    }

    /**
     * unset propertyValue
     *
     * @param scalar $index
     * @return void
     */
    public function unsetPropertyValue($index)
    {
        unset($this->propertyValue[$index]);
    }

    /**
     * Gets as propertyValue
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyValueType[]
     */
    public function getPropertyValue()
    {
        return $this->propertyValue;
    }

    /**
     * Sets a new propertyValue
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyValueType[] $propertyValue
     * @return self
     */
    public function setPropertyValue(array $propertyValue)
    {
        $this->propertyValue = $propertyValue;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isGInlineExpressionsValid($msg)) {
            return false;
        }

        return true;
    }
}
