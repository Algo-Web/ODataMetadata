<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Groups;

use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TFunctionImportParameterAndReturnTypeTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TMaxLengthFacetTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TParameterModeTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TPrecisionFacetTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TScaleFacetTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSridFacetTrait;

trait TFunctionImportParameterAttributesTrait
{
    use TSimpleIdentifierTrait, TParameterModeTrait, TFunctionImportParameterAndReturnTypeTrait, TMaxLengthFacetTrait,
        TPrecisionFacetTrait, TScaleFacetTrait, TSridFacetTrait {
        TSimpleIdentifierTrait::isNCName insteadof TFunctionImportParameterAndReturnTypeTrait, TPrecisionFacetTrait,
            TScaleFacetTrait, TSridFacetTrait;
        TSimpleIdentifierTrait::matchesRegexPattern insteadof TFunctionImportParameterAndReturnTypeTrait,
            TPrecisionFacetTrait, TScaleFacetTrait, TSridFacetTrait;
        TSimpleIdentifierTrait::isName insteadof TFunctionImportParameterAndReturnTypeTrait, TPrecisionFacetTrait,
            TScaleFacetTrait, TSridFacetTrait;
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

    /*
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property string $mode
     */
    private $mode = null;

    /**
     * @property string $maxLength
     */
    private $maxLength = null;

    /**
     * @property integer $precision
     */
    private $precision = null;

    /**
     * @property integer $scale
     */
    private $scale = null;

    /**
     * @property string $sRID
     */
    private $sRID = null;

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
        if (!$this->isTFunctionImportParameterAndReturnTypeValid($type)) {
            $msg = "Type must be a valid TFunctionImportParameterAndReturnType";
            throw new \InvalidArgumentException($msg);
        }
        $this->type = $type;
        return $this;
    }

    /**
     * Gets as mode
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Sets a new mode
     *
     * @param  string $mode
     * @return self
     */
    public function setMode($mode)
    {
        $msg = null;
        if (null != $mode && !$this->isTParameterModeValid($mode)) {
            $msg = "Mode must be a valid TParameterMode";
            throw new \InvalidArgumentException($msg);
        }
        $this->mode = $mode;
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
            $msg = "SRID must be a valid TSRIDFacet";
            throw new \InvalidArgumentException($msg);
        }
        $this->sRID = $sRID;
        return $this;
    }

    public function isTFunctionImportParameterAttributesValid(&$msg = null)
    {
        if (!$this->isTSimpleIdentifierValid($this->name)) {
            $msg = "Name must be a valid TSimpleIdentifier: " . get_class($this);
            return false;
        }
        if (!$this->isTFunctionImportParameterAndReturnTypeValid($this->type)) {
            $msg = "Type must be a valid TFunctionImportParameterAndReturnType: " . get_class($this);
            return false;
        }
        if (null != $this->mode && !$this->isTParameterModeValid($this->mode)) {
            $msg = "Mode must be a valid TParameterMode: " . get_class($this);
            return false;
        }
        if (null != $this->maxLength && !$this->isTMaxLengthFacetValid($this->maxLength)) {
            $msg = "Max length must be a valid TMaxLengthFacet: " . get_class($this);
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
            $msg = "SRID must be a valid TSRIDFacet: " . get_class($this);
            return false;
        }

        return true;
    }
}
