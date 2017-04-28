<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;
/**
 * Class representing TComplexTypePropertyType
 *
 *
 * XSD Type: TComplexTypeProperty
 */
class TComplexTypePropertyType
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property boolean $nullable
     */
    private $nullable = null;

    /**
     * @property string $defaultValue
     */
    private $defaultValue = null;

    /**
     * @property string $maxLength
     */
    private $maxLength = null;

    /**
     * @property boolean $fixedLength
     */
    private $fixedLength = null;

    /**
     * @property integer $precision
     */
    private $precision = null;

    /**
     * @property integer $scale
     */
    private $scale = null;

    /**
     * @property boolean $unicode
     */
    private $unicode = null;

    /**
     * @property string $collation
     */
    private $collation = null;

    /**
     * @property string $sRID
     */
    private $sRID = null;

    /**
     * @property string $concurrencyMode
     */
    private $concurrencyMode = null;

    /**
     * @property string $setterAccess
     */
    private $setterAccess = null;

    /**
     * @property string $getterAccess
     */
    private $getterAccess = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType[] $documentation
     */
    private $documentation = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType[] $valueAnnotation
     */
    private $valueAnnotation = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType[] $typeAnnotation
     */
    private $typeAnnotation = array(
        
    );

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets a new type
     *
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets as nullable
     *
     * @return boolean
     */
    public function getNullable()
    {
        return $this->nullable;
    }

    /**
     * Sets a new nullable
     *
     * @param boolean $nullable
     * @return self
     */
    public function setNullable($nullable)
    {
        $this->nullable = $nullable;
        return $this;
    }

    /**
     * Gets as defaultValue
     *
     * @return string
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * Sets a new defaultValue
     *
     * @param string $defaultValue
     * @return self
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

    /**
     * Gets as maxLength
     *
     * @return string
     */
    public function getMaxLength()
    {
        return $this->maxLength;
    }

    /**
     * Sets a new maxLength
     *
     * @param string $maxLength
     * @return self
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;
        return $this;
    }

    /**
     * Gets as fixedLength
     *
     * @return boolean
     */
    public function getFixedLength()
    {
        return $this->fixedLength;
    }

    /**
     * Sets a new fixedLength
     *
     * @param boolean $fixedLength
     * @return self
     */
    public function setFixedLength($fixedLength)
    {
        $this->fixedLength = $fixedLength;
        return $this;
    }

    /**
     * Gets as precision
     *
     * @return integer
     */
    public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * Sets a new precision
     *
     * @param integer $precision
     * @return self
     */
    public function setPrecision($precision)
    {
        $this->precision = $precision;
        return $this;
    }

    /**
     * Gets as scale
     *
     * @return integer
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * Sets a new scale
     *
     * @param integer $scale
     * @return self
     */
    public function setScale($scale)
    {
        $this->scale = $scale;
        return $this;
    }

    /**
     * Gets as unicode
     *
     * @return boolean
     */
    public function getUnicode()
    {
        return $this->unicode;
    }

    /**
     * Sets a new unicode
     *
     * @param boolean $unicode
     * @return self
     */
    public function setUnicode($unicode)
    {
        $this->unicode = $unicode;
        return $this;
    }

    /**
     * Gets as collation
     *
     * @return string
     */
    public function getCollation()
    {
        return $this->collation;
    }

    /**
     * Sets a new collation
     *
     * @param string $collation
     * @return self
     */
    public function setCollation($collation)
    {
        $this->collation = $collation;
        return $this;
    }

    /**
     * Gets as sRID
     *
     * @return string
     */
    public function getSRID()
    {
        return $this->sRID;
    }

    /**
     * Sets a new sRID
     *
     * @param string $sRID
     * @return self
     */
    public function setSRID($sRID)
    {
        $this->sRID = $sRID;
        return $this;
    }

    /**
     * Gets as concurrencyMode
     *
     * @return string
     */
    public function getConcurrencyMode()
    {
        return $this->concurrencyMode;
    }

    /**
     * Sets a new concurrencyMode
     *
     * @param string $concurrencyMode
     * @return self
     */
    public function setConcurrencyMode($concurrencyMode)
    {
        $this->concurrencyMode = $concurrencyMode;
        return $this;
    }

    /**
     * Gets as setterAccess
     *
     * @return string
     */
    public function getSetterAccess()
    {
        return $this->setterAccess;
    }

    /**
     * Sets a new setterAccess
     *
     * @param string $setterAccess
     * @return self
     */
    public function setSetterAccess($setterAccess)
    {
        $this->setterAccess = $setterAccess;
        return $this;
    }

    /**
     * Gets as getterAccess
     *
     * @return string
     */
    public function getGetterAccess()
    {
        return $this->getterAccess;
    }

    /**
     * Sets a new getterAccess
     *
     * @param string $getterAccess
     * @return self
     */
    public function setGetterAccess($getterAccess)
    {
        $this->getterAccess = $getterAccess;
        return $this;
    }

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
}
