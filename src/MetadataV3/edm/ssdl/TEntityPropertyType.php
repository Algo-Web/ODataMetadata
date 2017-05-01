<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TPropertyTypeTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TSimpleIdentifierTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TStoreGeneratedPatternTrait;

/**
 * Class representing TEntityPropertyType
 *
 *
 * XSD Type: TEntityProperty
 */
class TEntityPropertyType extends IsOK
{
    use TSimpleIdentifierTrait, TPropertyTypeTrait, TStoreGeneratedPatternTrait;
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
    private $nullable = true;

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
     * @property string $storeGeneratedPattern
     */
    private $storeGeneratedPattern = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType $documentation
     */
    private $documentation = null;

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
     * @param string $storeGeneratedPattern
     * @return self
     */
    public function setStoreGeneratedPattern($storeGeneratedPattern)
    {
        $this->storeGeneratedPattern = $storeGeneratedPattern;
        return $this;
    }

    /**
     * Gets as documentation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->name)) {
            $msg = "Name cannot be null or empty";
            return false;
        }
        if (!$this->isStringNotNullOrEmpty($this->type)) {
            $msg = "Type cannot be null or empty";
            return false;
        }
        if (null != $this->defaultValue && !$this->isStringNotNullOrEmpty($this->defaultValue)) {
            $msg = "Default value cannot be empty";
            return false;
        }
        if (null != $this->maxLength && !(is_numeric($this->maxLength) && 0 < $this->maxLength)) {
            $msg = "Max length must be positive and numeric";
            return false;
        }
        if (null != $this->precision && !(is_numeric($this->precision) && 0 < $this->precision)) {
            $msg = "Precision must be positive and numeric";
            return false;
        }
        if (null != $this->scale && !(is_numeric($this->scale) && 0 < $this->scale)) {
            $msg = "Scale must be positive and numeric";
            return false;
        }
        if (null != $this->collation && !$this->isStringNotNullOrEmpty($this->collation)) {
            $msg = "Collation cannot be empty";
            return false;
        }
        if (null != $this->sRID && !$this->isStringNotNullOrEmpty($this->sRID)) {
            $msg = "SRID cannot be empty";
            return false;
        }
        if (null != $this->storeGeneratedPattern && !$this->isStringNotNullOrEmpty($this->storeGeneratedPattern)) {
            $msg = "Store generated pattern cannot be empty";
            return false;
        }

        if (!$this->isTSimpleIdentifierValid($this->name)) {
            $msg = "Name must be valid TSimpleIdentifier";
            return false;
        }
        if (!$this->isTPropertyTypeValid($this->type)) {
            $msg = "Type must be valid TPropertyType";
            return false;
        }
        if (null != $this->storeGeneratedPattern
            && !$this->isTStoreGeneratedPatternValid($this->storeGeneratedPattern)) {
            $msg = "Store generated pattern must be valid TStoreGeneratedPattern";
            return false;
        }
        if (!$this->isObjectNullOrOK($this->documentation, $msg)) {
            return false;
        }

        return true;
    }
}
