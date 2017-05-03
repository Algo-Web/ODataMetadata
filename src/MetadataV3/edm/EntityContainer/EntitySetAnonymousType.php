<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\TEntitySetAttributesTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType;

/**
 * Class representing EntitySetAnonymousType
 */
class EntitySetAnonymousType extends IsOK
{
    use TEntitySetAttributesTrait;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType[] $documentation
     */
    private $documentation = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType[] $valueAnnotation
     */
    private $valueAnnotation = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType[] $typeAnnotation
     */
    private $typeAnnotation = [];
    
    /**
     * Adds as documentation
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     */
    public function addToDocumentation(TDocumentationType $documentation)
    {
        $this->documentation[] = $documentation;
        return $this;
    }

    /**
     * isset documentation
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetDocumentation($index)
    {
        return isset($this->documentation[$index]);
    }

    /**
     * unset documentation
     *
     * @param scalar $index
     * @return void
     */
    public function unsetDocumentation($index)
    {
        unset($this->documentation[$index]);
    }

    /**
     * Gets as documentation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType[]
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType[] $documentation
     * @return self
     */
    public function setDocumentation(array $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as valueAnnotation
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType $valueAnnotation
     */
    public function addToValueAnnotation(TValueAnnotationType $valueAnnotation)
    {
        $this->valueAnnotation[] = $valueAnnotation;
        return $this;
    }

    /**
     * isset valueAnnotation
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetValueAnnotation($index)
    {
        return isset($this->valueAnnotation[$index]);
    }

    /**
     * unset valueAnnotation
     *
     * @param scalar $index
     * @return void
     */
    public function unsetValueAnnotation($index)
    {
        unset($this->valueAnnotation[$index]);
    }

    /**
     * Gets as valueAnnotation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType[]
     */
    public function getValueAnnotation()
    {
        return $this->valueAnnotation;
    }

    /**
     * Sets a new valueAnnotation
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType[] $valueAnnotation
     * @return self
     */
    public function setValueAnnotation(array $valueAnnotation)
    {
        $this->valueAnnotation = $valueAnnotation;
        return $this;
    }

    /**
     * Adds as typeAnnotation
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType $typeAnnotation
     */
    public function addToTypeAnnotation(TTypeAnnotationType $typeAnnotation)
    {
        $this->typeAnnotation[] = $typeAnnotation;
        return $this;
    }

    /**
     * isset typeAnnotation
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetTypeAnnotation($index)
    {
        return isset($this->typeAnnotation[$index]);
    }

    /**
     * unset typeAnnotation
     *
     * @param scalar $index
     * @return void
     */
    public function unsetTypeAnnotation($index)
    {
        unset($this->typeAnnotation[$index]);
    }

    /**
     * Gets as typeAnnotation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType[]
     */
    public function getTypeAnnotation()
    {
        return $this->typeAnnotation;
    }

    /**
     * Sets a new typeAnnotation
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType[] $typeAnnotation
     * @return self
     */
    public function setTypeAnnotation(array $typeAnnotation)
    {
        $this->typeAnnotation = $typeAnnotation;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isTEntitySetAttributesOK($msg)) {
            return false;
        }
        return true;
    }
}
