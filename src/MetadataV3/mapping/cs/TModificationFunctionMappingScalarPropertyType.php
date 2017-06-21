<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits\TSimpleIdentifierTrait;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits\TVersionTrait;

/**
 * Class representing TModificationFunctionMappingScalarPropertyType
 *
 * Type for function mapping scalar property
 *
 * XSD Type: TModificationFunctionMappingScalarProperty
 */
class TModificationFunctionMappingScalarPropertyType extends IsOK
{
    use TSimpleIdentifierTrait, TVersionTrait;
    /**
     * @property string $parameterName
     */
    private $parameterName = null;

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $version
     */
    private $version = null;

    /**
     * Gets as parameterName
     *
     * @return string
     */
    public function getParameterName()
    {
        return $this->parameterName;
    }

    /**
     * Sets a new parameterName
     *
     * @param  string $parameterName
     * @return self
     */
    public function setParameterName($parameterName)
    {
        if (!$this->isStringNotNullOrEmpty($parameterName)) {
            $msg = "Parameter name cannot be null or empty";
            throw new \InvalidArgumentException($msg);
        }
        $this->parameterName = $parameterName;
        return $this;
    }

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
        if (!$this->isStringNotNullOrEmpty($name)) {
            $msg = "Name cannot be null or empty";
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTSimpleIdentifierValid($name)) {
            $msg = 'Name must be a valid TSimpleIdentifier';
            throw new \InvalidArgumentException($msg);
        }
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Sets a new version
     *
     * @param  string $version
     * @return self
     */
    public function setVersion($version)
    {
        if (null != $this->version && !$this->isTVersionValid($version)) {
            $msg = "If set, version must be a valid TVersion";
            throw new \InvalidArgumentException($msg);
        }
        $this->version = $version;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->parameterName)) {
            $msg = "Parameter name cannot be null or empty";
            return false;
        }
        if (!$this->isStringNotNullOrEmpty($this->name)) {
            $msg = "Name cannot be null or empty";
            return false;
        }
        if (!$this->isTSimpleIdentifierValid($this->name)) {
            $msg = 'Name must be a valid TSimpleIdentifier';
            return false;
        }
        if (null != $this->version && !$this->isTVersionValid($this->version)) {
            $msg = "If set, version must be a valid TVersion";
            return false;
        }
        return true;
    }
}
