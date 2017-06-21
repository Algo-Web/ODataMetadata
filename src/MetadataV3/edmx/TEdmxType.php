<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edmx;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Schema;

/**
 * Class representing TEdmxType
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
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edmx\TDataServicesType $dataServiceType
     */
    private $dataServiceType = null;

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
        if (!$this->isStringNotNullOrEmpty($version)) {
            $msg = "Version cannot be null or empty";
            throw new \InvalidArgumentException($msg);
        }
        $this->version = $version;
        return $this;
    }

    /**
     * Gets data service type
     *
     * @return TDataServicesType
     */
    public function getDataServiceType()
    {
        return $this->dataServiceType;
    }

    /**
     * Sets a new data service type
     *
     * @param  TDataServicesType $dataServiceType
     * @return self
     */
    public function setDataServiceType(TDataServicesType $dataServiceType)
    {
        $msg = null;
        if (!$dataServiceType->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->dataServiceType = $dataServiceType;
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
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edmx\TDesignerType $designer
     * @return self
     */
    public function setDesigner(TDesignerType $designer)
    {
        $msg = null;
        if (!$designer->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
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
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edmx\TRuntimeType $runtime
     * @return self
     */
    public function setRuntime(TRuntimeType $runtime)
    {
        $msg = null;
        if (!$runtime->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->runtime = $runtime;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->version)) {
            $msg = "Version cannot be null or empty";
            return false;
        }
        if (!$this->dataServiceType instanceof TDataServicesType) {
            $msg = "Data service type cannot be null";
            return false;
        }
        if (null != $this->designer && !$this->designer->isOK($msg)) {
            return false;
        }
        if (null != $this->runtime && !$this->runtime->isOK($msg)) {
            return false;
        }
        if (!$this->dataServiceType->isOK($msg)) {
            return false;
        }

        return true;
    }
}
