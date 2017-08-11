<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TRecordExpressionType.
 *
 * XSD Type: TRecordExpression
 */
class TRecordExpressionType extends IsOK
{

    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TPropertyValueType[] $propertyValue
     */
    private $propertyValue = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $annotation
     */
    private $annotation = array();

    /**
     * Gets as type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets a new type.
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Adds as propertyValue.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TPropertyValueType $propertyValue
     * @return self
     */
    public function addToPropertyValue(TPropertyValueType $propertyValue)
    {
        $this->propertyValue[] = $propertyValue;
        return $this;
    }

    /**
     * isset propertyValue.
     *
     * @param  int $index
     * @return bool
     */
    public function issetPropertyValue($index)
    {
        return isset($this->propertyValue[$index]);
    }

    /**
     * unset propertyValue.
     *
     * @param  int $index
     * @return void
     */
    public function unsetPropertyValue($index)
    {
        unset($this->propertyValue[$index]);
    }

    /**
     * Gets as propertyValue.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TPropertyValueType[]
     */
    public function getPropertyValue()
    {
        return $this->propertyValue;
    }

    /**
     * Sets a new propertyValue.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TPropertyValueType[] $propertyValue
     * @return self
     */
    public function setPropertyValue(array $propertyValue)
    {
        $this->propertyValue = $propertyValue;
        return $this;
    }

    /**
     * Adds as annotation.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation $annotation
     * @return self
     */
    public function addToAnnotation(Annotation $annotation)
    {
        $this->annotation[] = $annotation;
        return $this;
    }

    /**
     * isset annotation.
     *
     * @param  int $index
     * @return bool
     */
    public function issetAnnotation($index)
    {
        return isset($this->annotation[$index]);
    }

    /**
     * unset annotation.
     *
     * @param  int $index
     * @return void
     */
    public function unsetAnnotation($index)
    {
        unset($this->annotation[$index]);
    }

    /**
     * Gets as annotation.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[]
     */
    public function getAnnotation()
    {
        return $this->annotation;
    }

    /**
     * Sets a new annotation.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $annotation
     * @return self
     */
    public function setAnnotation(array $annotation)
    {
        $this->annotation = $annotation;
        return $this;
    }
}
