<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\Annotations\TGenerationPatternTrait;
use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\TCommonPropertyAttributesTrait;

/**
 * Class representing TEntityPropertyType
 *
 * XSD Type: TEntityProperty
 */
class TEntityPropertyType extends IsOK
{
    use TCommonPropertyAttributesTrait, TGenerationPatternTrait {
        TCommonPropertyAttributesTrait::normaliseString insteadof TGenerationPatternTrait;
        TCommonPropertyAttributesTrait::preserveString insteadof TGenerationPatternTrait;
        TCommonPropertyAttributesTrait::replaceString insteadof TGenerationPatternTrait;
        TCommonPropertyAttributesTrait::collapseString insteadof TGenerationPatternTrait;
        TCommonPropertyAttributesTrait::token insteadof TGenerationPatternTrait;
        TCommonPropertyAttributesTrait::string insteadof TGenerationPatternTrait;
        TCommonPropertyAttributesTrait::integer insteadof TGenerationPatternTrait;
        TCommonPropertyAttributesTrait::nonNegativeInteger insteadof TGenerationPatternTrait;
        TCommonPropertyAttributesTrait::decimal insteadof TGenerationPatternTrait;
        TCommonPropertyAttributesTrait::double insteadof TGenerationPatternTrait;
        TCommonPropertyAttributesTrait::dateTime insteadof TGenerationPatternTrait;
        TCommonPropertyAttributesTrait::hexBinary insteadof TGenerationPatternTrait;
    }
 
    /**
     * @property string $storeGeneratedPattern
     */
    private $storeGeneratedPattern = null;

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
     * Gets as storeGeneratedPattern
     *
     * @return string
     */
    public function getStoreGeneratedPattern()
    {
        return $this->storeGeneratedPattern;
    }

    /**
     * Sets a new storeGeneratedPattern
     *
     * @param  string $storeGeneratedPattern
     * @return self
     */
    public function setStoreGeneratedPattern($storeGeneratedPattern)
    {
        if (null != $storeGeneratedPattern && !$this->isTGenerationPatternValid($storeGeneratedPattern)) {
            $msg = "Store generation pattern must be a valid TGenerationPattern: " . get_class($this);
            throw new \InvalidArgumentException($msg);
        }
        $this->storeGeneratedPattern = $storeGeneratedPattern;
        return $this;
    }

    /**
     * Adds as documentation
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     */
    public function addToDocumentation(TDocumentationType $documentation)
    {
        $msg = null;
        if (!$documentation->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->documentation[] = $documentation;
        return $this;
    }

    /**
     * isset documentation
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetDocumentation($index)
    {
        return isset($this->documentation[$index]);
    }

    /**
     * unset documentation
     *
     * @param  scalar $index
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
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType[] $documentation
     * @return self
     */
    public function setDocumentation(array $documentation)
    {
        if (!$this->isValidArrayOK(
            $documentation,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType',
            $msg,
            0,
            1
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as valueAnnotation
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType $valueAnnotation
     */
    public function addToValueAnnotation(TValueAnnotationType $valueAnnotation)
    {
        $msg = null;
        if (!$valueAnnotation->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->valueAnnotation[] = $valueAnnotation;
        return $this;
    }

    /**
     * isset valueAnnotation
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetValueAnnotation($index)
    {
        return isset($this->valueAnnotation[$index]);
    }

    /**
     * unset valueAnnotation
     *
     * @param  scalar $index
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
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType[] $valueAnnotation
     * @return self
     */
    public function setValueAnnotation(array $valueAnnotation)
    {
        if (!$this->isValidArrayOK(
            $valueAnnotation,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->valueAnnotation = $valueAnnotation;
        return $this;
    }

    /**
     * Adds as typeAnnotation
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType $typeAnnotation
     */
    public function addToTypeAnnotation(TTypeAnnotationType $typeAnnotation)
    {
        $msg = null;
        if (!$typeAnnotation->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->typeAnnotation[] = $typeAnnotation;
        return $this;
    }

    /**
     * isset typeAnnotation
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetTypeAnnotation($index)
    {
        return isset($this->typeAnnotation[$index]);
    }

    /**
     * unset typeAnnotation
     *
     * @param  scalar $index
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
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType[] $typeAnnotation
     * @return self
     */
    public function setTypeAnnotation(array $typeAnnotation)
    {
        if (!$this->isValidArrayOK(
            $typeAnnotation,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->typeAnnotation = $typeAnnotation;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (null != $this->storeGeneratedPattern && !$this->isTGenerationPatternValid($this->storeGeneratedPattern)) {
            $msg = "Store generation pattern must be a valid TGenerationPattern: " . get_class($this);
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->documentation,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType',
            $msg,
            0,
            1
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->valueAnnotation,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType',
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->typeAnnotation,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType',
            $msg
        )
        ) {
            return false;
        }

        if (!$this->isTCommonPropertyAttributesValid($msg)) {
            return false;
        }
        return true;
    }
}
