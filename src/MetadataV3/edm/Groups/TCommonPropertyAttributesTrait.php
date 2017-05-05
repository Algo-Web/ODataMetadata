<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Groups;

use AlgoWeb\ODataMetadata\CodeGeneration\AccessTypeTraits;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TCollationFacetTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TConcurrencyModeTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TIsFixedLengthFacetTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TIsUnicodeFacetTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TMaxLengthFacetTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TPrecisionFacetTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TPropertyTypeTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TScaleFacetTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSridFacetTrait;

trait TCommonPropertyAttributesTrait
{
    use TSimpleIdentifierTrait, TMaxLengthFacetTrait, TIsFixedLengthFacetTrait, TPrecisionFacetTrait, TScaleFacetTrait,
        TIsUnicodeFacetTrait, TCollationFacetTrait, TSridFacetTrait, TConcurrencyModeTrait, AccessTypeTraits,
        IsOKToolboxTrait, TPropertyTypeTrait;

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

    public function isTCommonPropertyAttributesValid(&$msg = null)
    {
        if (!$this->isTSimpleIdentifierValid($this->name)) {
            $msg = "Name must be a valid TSimpleIdentifier";
            return false;
        }
        if (!$this->isTPropertyTypeValid($this->type)) {
            $msg = "Type must be a valid TPropertyType";
            return false;
        }
        if (null != $this->nullable && $this->nullable !== boolval($this->nullable)) {
            $msg = "Nullable must be boolean";
            return false;
        }
        if (null != $this->defaultValue && !is_string($this->defaultValue)) {
            $msg = "Default value must be a string";
            return false;
        }
        if (null != $this->maxLength && !$this->isTMaxLengthFacetValid($this->maxLength)) {
            $msg = "Max length must be a valid TMaxLengthFacet";
            return false;
        }
        if (null != $this->fixedLength && !$this->isTIsFixedLengthFacetTraitValid($this->fixedLength)) {
            $msg = "Max length must be a valid TFixedLengthFacet";
            return false;
        }
        if (null != $this->precision && !$this->isTPrecisionFacetValid($this->precision)) {
            $msg = "Precision must be a valid TPrecisionFacet";
            return false;
        }
        if (null != $this->scale && !$this->isTScaleFacetValid($this->scale)) {
            $msg = "Scale must be a valid TScaleFacet";
            return false;
        }
        if (null != $this->unicode && !$this->isTIsUnicodeFacetTraitValid($this->unicode)) {
            $msg = "Unicode must be a valid TUnicodeFacet";
            return false;
        }
        if (null != $this->collation && !$this->isTCollationFacetValid($this->collation)) {
            $msg = "Collation must be a valid TCollationFacet";
            return false;
        }
        if (null != $this->sRID && !$this->isTSridFacetValid($this->sRID)) {
            $msg = "SRID must be a valid TSridFacet";
            return false;
        }
        if (null != $this->concurrencyMode && !$this->isTConcurrencyModeValid($this->concurrencyMode)) {
            $msg = "ConcurrencyMode must be a valid TConcurrencyMode";
            return false;
        }
        if (null != $this->setterAccess && !$this->isTAccessOk($this->setterAccess)) {
            $msg = "Setter access must be a valid TAccess";
            return false;
        }
        if (null != $this->getterAccess && !$this->isTAccessOk($this->getterAccess)) {
            $msg = "Getter access must be a valid TAccess";
            return false;
        }

        return true;
    }
}
