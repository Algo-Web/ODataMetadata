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
        IsOKToolboxTrait, TPropertyTypeTrait {
            TMaxLengthFacetTrait::normaliseString insteadof TPrecisionFacetTrait, TScaleFacetTrait, TSridFacetTrait;
            TMaxLengthFacetTrait::preserveString insteadof TPrecisionFacetTrait, TScaleFacetTrait, TSridFacetTrait;
            TMaxLengthFacetTrait::replaceString insteadof TPrecisionFacetTrait, TScaleFacetTrait, TSridFacetTrait;
            TMaxLengthFacetTrait::collapseString insteadof TPrecisionFacetTrait, TScaleFacetTrait, TSridFacetTrait;
            TMaxLengthFacetTrait::token insteadof TPrecisionFacetTrait, TScaleFacetTrait, TSridFacetTrait;
            TMaxLengthFacetTrait::string insteadof TPrecisionFacetTrait, TScaleFacetTrait, TSridFacetTrait;
            TMaxLengthFacetTrait::integer insteadof TPrecisionFacetTrait, TScaleFacetTrait, TSridFacetTrait;
            TMaxLengthFacetTrait::nonNegativeInteger insteadof TPrecisionFacetTrait, TScaleFacetTrait, TSridFacetTrait;
            TMaxLengthFacetTrait::decimal insteadof TPrecisionFacetTrait, TScaleFacetTrait, TSridFacetTrait;
            TMaxLengthFacetTrait::double insteadof TPrecisionFacetTrait, TScaleFacetTrait, TSridFacetTrait;
            TMaxLengthFacetTrait::dateTime insteadof TPrecisionFacetTrait, TScaleFacetTrait, TSridFacetTrait;
            TMaxLengthFacetTrait::hexBinary insteadof TPrecisionFacetTrait, TScaleFacetTrait, TSridFacetTrait;
            TSimpleIdentifierTrait::isNCName insteadof TPrecisionFacetTrait, TScaleFacetTrait, TSridFacetTrait,
                TMaxLengthFacetTrait, TPropertyTypeTrait;
            TSimpleIdentifierTrait::matchesRegexPattern insteadof TPrecisionFacetTrait, TScaleFacetTrait,
                TSridFacetTrait, TMaxLengthFacetTrait, TPropertyTypeTrait;
            TSimpleIdentifierTrait::isName insteadof TPrecisionFacetTrait, TScaleFacetTrait, TSridFacetTrait,
                TMaxLengthFacetTrait, TPropertyTypeTrait;
    }

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
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $msg = null;
        if (!$this->isTSimpleIdentifierValid($name)) {
            $msg = "Name must be a valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
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
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        $msg = null;
        if (!$this->isTPropertyTypeValid($type)) {
            $msg = "Type must be a valid TPropertyType";
            throw new \InvalidArgumentException($msg);
        }
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
        if (is_numeric($defaultValue)) {
            $defaultValue = strval($defaultValue);
        }
        if (null !== $defaultValue && !is_string($defaultValue)) {
            $msg = "Default value must be resolvable to a string";
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
        $msg = null;
        if (null != $maxLength && !$this->isTMaxLengthFacetValid($maxLength)) {
            $msg = "Max length must be a valid TMaxLengthFacet";
            throw new \InvalidArgumentException($msg);
        }
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
     * @param  boolean $fixedLength
     * @return self
     */
    public function setFixedLength($fixedLength)
    {
        $this->fixedLength = boolval($fixedLength);
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
        $msg = null;
        if (null != $precision && !$this->isTPrecisionFacetValid($precision)) {
            $msg = "Precision must be a valid TPrecisionFacet";
            throw new \InvalidArgumentException($msg);
        }
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
        $msg = null;
        if (null != $scale && !$this->isTScaleFacetValid($scale)) {
            $msg = "Scale must be a valid TScaleFacet";
            throw new \InvalidArgumentException($msg);
        }
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
        $this->unicode = boolval($unicode);
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
        $msg = null;
        if (null != $sRID && !$this->isTSridFacetValid($sRID)) {
            $msg = "SRID must be a valid TSridFacet";
            throw new \InvalidArgumentException($msg);
        }
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
     * @param  string $concurrencyMode
     * @return self
     */
    public function setConcurrencyMode($concurrencyMode)
    {
        $msg = null;
        if (null != $concurrencyMode && !$this->isTConcurrencyModeValid($concurrencyMode)) {
            $msg = "ConcurrencyMode must be a valid TConcurrencyMode";
            throw new \InvalidArgumentException($msg);
        }
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
     * @param  string $setterAccess
     * @return self
     */
    public function setSetterAccess($setterAccess)
    {
        $msg = null;
        if (null != $setterAccess && !$this->isTAccessOk($setterAccess)) {
            $msg = "Setter access must be a valid TAccess";
            throw new \InvalidArgumentException($msg);
        }
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
     * @param  string $getterAccess
     * @return self
     */
    public function setGetterAccess($getterAccess)
    {
        $msg = null;
        if (null != $getterAccess && !$this->isTAccessOk($getterAccess)) {
            $msg = "Getter access must be a valid TAccess";
            throw new \InvalidArgumentException($msg);
        }
        $this->getterAccess = $getterAccess;
        return $this;
    }

    public function isTCommonPropertyAttributesValid(&$msg = null)
    {
        if (!$this->isTSimpleIdentifierValid($this->name)) {
            $msg = "Name must be a valid TSimpleIdentifier: " . get_class($this);
            return false;
        }
        if (!$this->isTPropertyTypeValid($this->type)) {
            $msg = "Type must be a valid TPropertyType: " . get_class($this);
            return false;
        }
        if (null != $this->nullable && $this->nullable !== boolval($this->nullable)) {
            $msg = "Nullable must be boolean: " . get_class($this);
            return false;
        }
        if (null != $this->defaultValue && !is_string($this->defaultValue)) {
            $msg = "Default value must be a string: " . get_class($this);
            return false;
        }
        if (null != $this->maxLength && !$this->isTMaxLengthFacetValid($this->maxLength)) {
            $msg = "Max length must be a valid TMaxLengthFacet: " . get_class($this);
            return false;
        }
        if (null != $this->fixedLength && !$this->isTIsFixedLengthFacetTraitValid($this->fixedLength)) {
            $msg = "Max length must be a valid TFixedLengthFacet: " . get_class($this);
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
        if (null != $this->unicode && !$this->isTIsUnicodeFacetTraitValid($this->unicode)) {
            $msg = "Unicode must be a valid TUnicodeFacet: " . get_class($this);
            return false;
        }
        if (null != $this->collation && !$this->isTCollationFacetValid($this->collation)) {
            $msg = "Collation must be a valid TCollationFacet: " . get_class($this);
            return false;
        }
        if (null != $this->sRID && !$this->isTSridFacetValid($this->sRID)) {
            $msg = "SRID must be a valid TSridFacet: " . get_class($this);
            return false;
        }
        if (null != $this->concurrencyMode && !$this->isTConcurrencyModeValid($this->concurrencyMode)) {
            $msg = "ConcurrencyMode must be a valid TConcurrencyMode: " . get_class($this);
            return false;
        }
        if (null != $this->setterAccess && !$this->isTAccessOk($this->setterAccess)) {
            $msg = "Setter access must be a valid TAccess: " . get_class($this);
            return false;
        }
        if (null != $this->getterAccess && !$this->isTAccessOk($this->getterAccess)) {
            $msg = "Getter access must be a valid TAccess: " . get_class($this);
            return false;
        }

        return true;
    }
}
