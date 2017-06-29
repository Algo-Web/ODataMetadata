<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Groups;

use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TCollationFacetTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TIsFixedLengthFacetTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TIsUnicodeFacetTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TMaxLengthFacetTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TPrecisionFacetTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TScaleFacetTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSridFacetTrait;

trait TFacetAttributesTrait
{
    use IsOKToolboxTrait, TMaxLengthFacetTrait, TIsFixedLengthFacetTrait, TPrecisionFacetTrait, TScaleFacetTrait,
        TIsUnicodeFacetTrait, TSridFacetTrait, TCollationFacetTrait {
        TPrecisionFacetTrait::normaliseString insteadof TScaleFacetTrait, TSridFacetTrait, TMaxLengthFacetTrait;
        TPrecisionFacetTrait::preserveString insteadof TScaleFacetTrait, TSridFacetTrait, TMaxLengthFacetTrait;
        TPrecisionFacetTrait::replaceString insteadof TScaleFacetTrait, TSridFacetTrait, TMaxLengthFacetTrait;
        TPrecisionFacetTrait::collapseString insteadof TScaleFacetTrait, TSridFacetTrait, TMaxLengthFacetTrait;
        TPrecisionFacetTrait::token insteadof TScaleFacetTrait, TSridFacetTrait, TMaxLengthFacetTrait;
        TPrecisionFacetTrait::string insteadof TScaleFacetTrait, TSridFacetTrait, TMaxLengthFacetTrait;
        TPrecisionFacetTrait::integer insteadof TScaleFacetTrait, TSridFacetTrait, TMaxLengthFacetTrait;
        TPrecisionFacetTrait::nonNegativeInteger insteadof TScaleFacetTrait, TSridFacetTrait, TMaxLengthFacetTrait;
        TPrecisionFacetTrait::decimal insteadof TScaleFacetTrait, TSridFacetTrait, TMaxLengthFacetTrait;
        TPrecisionFacetTrait::double insteadof TScaleFacetTrait, TSridFacetTrait, TMaxLengthFacetTrait;
        TPrecisionFacetTrait::dateTime insteadof TScaleFacetTrait, TSridFacetTrait, TMaxLengthFacetTrait;
        TPrecisionFacetTrait::hexBinary insteadof TScaleFacetTrait, TSridFacetTrait, TMaxLengthFacetTrait;
    }

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
     * @property TCollationFacet $collation
     */
    private $collation = null;

    /**
     * @property string $sRID
     */
    private $sRID = null;

    /**
     * Gets as nullable
     *
     * @return boolean
     */
    public function getNullable()
    {
        return boolval($this->nullable);
    }

    /**
     * Sets a new nullable
     *
     * @param  boolean $nullable
     * @return self
     */
    public function setNullable($nullable)
    {
        $this->nullable = boolval($nullable);
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
     * @param  string $defaultValue
     * @return self
     */
    public function setDefaultValue($defaultValue)
    {
        $msg = null;
        if (null !== $defaultValue && !is_string($defaultValue)) {
            $msg = "Default value must be a string";
            throw new \InvalidArgumentException($msg);
        }
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
     * @param  string $maxLength
     * @return self
     */
    public function setMaxLength($maxLength)
    {
        null == $maxLength || $this->isTMaxLengthFacetValid($maxLength);
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
        return boolval($this->fixedLength);
    }

    /**
     * Sets a new fixedLength
     *
     * @param  boolean $fixedLength
     * @return self
     */
    public function setFixedLength($fixedLength)
    {
        $msg = null;
        if (null != $fixedLength && !$this->isTIsFixedLengthFacetTraitValid($fixedLength)) {
            $msg = "Fixed length must be a valid TFixedLengthFacet";
            throw new \InvalidArgumentException($msg);
        }
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
     * @param  integer $precision
     * @return self
     */
    public function setPrecision($precision)
    {
        null == $precision || !$this->isTPrecisionFacetValid($precision);
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
     * @param  integer $scale
     * @return self
     */
    public function setScale($scale)
    {
        null == $scale || $this->isTScaleFacetValid($scale);
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
     * @param  boolean $unicode
     * @return self
     */
    public function setUnicode($unicode)
    {
        $msg = null;
        if (null != $unicode && !$this->isTIsUnicodeFacetTraitValid($unicode)) {
            $msg = "Unicode must be a valid TUnicodeFacet";
            throw new \InvalidArgumentException($msg);
        }
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
     * @param  string $collation
     * @return self
     */
    public function setCollation($collation)
    {
        $msg = null;
        if (null != $collation && !$this->isTCollationFacetValid($collation)) {
            $msg = "Collation must be a valid TCollationFacet";
            throw new \InvalidArgumentException($msg);
        }
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
     * @param  string $sRID
     * @return self
     */
    public function setSRID($sRID)
    {
        $this->isTSridFacetValid($sRID);
        $this->sRID = $sRID;
        return $this;
    }

    public function isTFacetAttributesTraitValid(&$msg = null)
    {
        if ($this->nullable !== boolval($this->nullable)) {
            $msg = "Nullable must be boolean: " . get_class($this);
            return false;
        }
        if (null != $this->defaultValue && !is_string($this->defaultValue)) {
            $msg = "Default value must be a string: " . get_class($this);
            return false;
        }
        if (null != $this->collation && !$this->isTCollationFacetValid($this->collation)) {
            $msg = "Collation must be a valid TCollationFacet: " . get_class($this);
            return false;
        }
        if (null != $this->maxLength && !$this->isTMaxLengthFacetValid($this->maxLength)) {
            $msg = "Max length must be a valid TMaxLengthFacet: " . get_class($this);
            return false;
        }
        if (null != $this->fixedLength && !$this->isTIsFixedLengthFacetTraitValid($this->fixedLength)) {
            $msg = "Fixed length must be a valid TFixedLengthFacet: " . get_class($this);
            return false;
        }
        if (null != $this->precision && !$this->isTPrecisionFacetValid($this->precision)) {
            $msg = "Precision must be a valid TPrecisionFacet: " . get_class($this);
            return false;
        }
        if (null != $this->scale && !$this->isTScaleFacetValid($this->scale)) {
            $msg = "Scale must be a valid TScaleFacet: " . get_class($this);
            return false;
        }
        if (null != $this->sRID && !$this->isTSridFacetValid($this->sRID)) {
            $msg = "SRID must be a valid TSridFacet: " . get_class($this);
            return false;
        }
        if (null != $this->unicode && !$this->isTIsUnicodeFacetTraitValid($this->unicode)) {
            $msg = "Unicode must be a valid TUnicodeFacet: " . get_class($this);
            return false;
        }

        return true;
    }
}
