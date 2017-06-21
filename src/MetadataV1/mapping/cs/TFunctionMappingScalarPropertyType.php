<?php

namespace AlgoWeb\ODataMetadata\MetadataV1\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TFunctionMappingScalarPropertyType
 *
 * XSD Type: TFunctionMappingScalarProperty
 */
class TFunctionMappingScalarPropertyType extends IsOK
{

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
        $this->version = $version;
        return $this;
    }
}
