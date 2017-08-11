<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TFunctionTypeTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TParameterModeTrait;

/**
 * Class representing TParameterType.
 *
 * XSD Type: TParameter
 */
class TParameterType extends IsOK
{
    use TParameterModeTrait, TFunctionTypeTrait;
    /**
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
     * @property int $precision
     */
    private $precision = null;

    /**
     * @property int $scale
     */
    private $scale = null;

    /**
     * @property string $sRID
     */
    private $sRID = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * Gets as name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name.
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        if (!$this->isStringNotNullOrEmpty($name)) {
            $msg = 'Name cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        $this->name = $name;
        return $this;
    }

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
        if (!$this->isStringNotNullOrEmpty($type)) {
            $msg = 'Type cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        if (null != $type && !$this->isTFunctionTypeValid($type)) {
            $msg = 'Type must be a valid TFunctionType';
            throw new \InvalidArgumentException($msg);
        }
        $this->type = $type;
        return $this;
    }

    /**
     * Gets as mode.
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Sets a new mode.
     *
     * @param  string $mode
     * @return self
     */
    public function setMode($mode)
    {
        if (null != $mode && !$this->isStringNotNullOrEmpty($mode)) {
            $msg = 'Mode cannot be empty';
            throw new \InvalidArgumentException($msg);
        }
        if (null != $mode && !$this->isTParameterModeValid($mode)) {
            $msg = 'Mode must be a valid TParameterMode';
            throw new \InvalidArgumentException($msg);
        }
        $this->mode = $mode;
        return $this;
    }

    /**
     * Gets as maxLength.
     *
     * @return string
     */
    public function getMaxLength()
    {
        return $this->maxLength;
    }

    /**
     * Sets a new maxLength.
     *
     * @param  string $maxLength
     * @return self
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;
        return $this;
    }

    /**
     * Gets as precision.
     *
     * @return int
     */
    public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * Sets a new precision.
     *
     * @param  int  $precision
     * @return self
     */
    public function setPrecision($precision)
    {
        $this->precision = $precision;
        return $this;
    }

    /**
     * Gets as scale.
     *
     * @return int
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * Sets a new scale.
     *
     * @param  int  $scale
     * @return self
     */
    public function setScale($scale)
    {
        $this->scale = $scale;
        return $this;
    }

    /**
     * Gets as sRID.
     *
     * @return string
     */
    public function getSRID()
    {
        return $this->sRID;
    }

    /**
     * Sets a new sRID.
     *
     * @param  string $sRID
     * @return self
     */
    public function setSRID($sRID)
    {
        if (null != $sRID && !$this->isStringNotNullOrEmpty($sRID)) {
            $msg = 'SRID cannot be empty';
            throw new \InvalidArgumentException($msg);
        }
        $this->sRID = $sRID;
        return $this;
    }

    /**
     * Gets as documentation.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $msg = null;
        if (!$documentation->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->documentation = $documentation;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->name)) {
            $msg = 'Name cannot be null or empty';
            return false;
        }
        if (!$this->isStringNotNullOrEmpty($this->type)) {
            $msg = 'Type cannot be null or empty';
            return false;
        }
        if (null != $this->mode && !$this->isStringNotNullOrEmpty($this->mode)) {
            $msg = 'Mode cannot be empty';
            return false;
        }
        if (null != $this->sRID && !$this->isStringNotNullOrEmpty($this->sRID)) {
            $msg = 'SRID cannot be empty';
            return false;
        }
        if (null != $this->type && !$this->isTFunctionTypeValid($this->type)) {
            $msg = 'Type must be a valid TFunctionType';
            return false;
        }
        if (null != $this->mode && !$this->isTParameterModeValid($this->mode)) {
            $msg = 'Mode must be a valid TParameterMode';
            return false;
        }

        return true;
    }
}
