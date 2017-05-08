<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edmx;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Schema;

/**
 * Class representing TEdmxType
 *
 *
 * XSD Type: TEdmx
 */
class TEdmxType extends IsOK
{

    /**
     * @property string $version
     */
    private $version = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edmx\TDesignerType $designer
     */
    private $designer = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edmx\TRuntimeType $runtime
     */
    private $runtime = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\Schema[] $dataServices
     */
    private $dataServices = [];

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
     * @param string $version
     * @return self
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Gets as designer
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edmx\TDesignerType
     */
    public function getDesigner()
    {
        return $this->designer;
    }

    /**
     * Sets a new designer
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edmx\TDesignerType $designer
     * @return self
     */
    public function setDesigner(TDesignerType $designer)
    {
        $this->designer = $designer;
        return $this;
    }

    /**
     * Gets as runtime
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edmx\TRuntimeType
     */
    public function getRuntime()
    {
        return $this->runtime;
    }

    /**
     * Sets a new runtime
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edmx\TRuntimeType $runtime
     * @return self
     */
    public function setRuntime(TRuntimeType $runtime)
    {
        $this->runtime = $runtime;
        return $this;
    }

    /**
     * Adds as schema
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\Schema $schema
     */
    public function addToDataServices(Schema $schema)
    {
        $this->dataServices[] = $schema;
        return $this;
    }

    /**
     * isset dataServices
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetDataServices($index)
    {
        return isset($this->dataServices[$index]);
    }

    /**
     * unset dataServices
     *
     * @param scalar $index
     * @return void
     */
    public function unsetDataServices($index)
    {
        unset($this->dataServices[$index]);
    }

    /**
     * Gets as dataServices
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\Schema[]
     */
    public function getDataServices()
    {
        return $this->dataServices;
    }

    /**
     * Sets a new dataServices
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\Schema[] $dataServices
     * @return self
     */
    public function setDataServices(array $dataServices)
    {
        $this->dataServices = $dataServices;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->version)) {
            $msg = "Version cannot be null or empty";
            return false;
        }
        if (null != $this->designer && !$this->designer->isOK($msg)) {
            return false;
        }
        if (null != $this->runtime && !$this->runtime->isOK($msg)) {
            return false;
        }

        if (!$this->isValidArray(
            $this->dataServices,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\Schema'
        )) {
            $msg = "Data services array not a valid array";
            return false;
        }
        if (null == $this->runtime && 0 == count($this->dataServices)) {
            $msg = "Either a runtime or a dataservice must be defined for Tedmx";
            return false;
        }

        if (!$this->isChildArrayOK($this->dataServices, $msg)) {
            return false;
        }
        return true;
    }
}
