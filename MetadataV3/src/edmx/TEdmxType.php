<?php

namespace MetadataV3\edmx;

/**
 * Class representing TEdmxType
 *
 *
 * XSD Type: TEdmx
 */
class TEdmxType
{

    /**
     * @property string $version
     */
    private $version = null;

    /**
     * @property \MetadataV3\edmx\TDesignerType $designer
     */
    private $designer = null;

    /**
     * @property \MetadataV3\edmx\TRuntimeType $runtime
     */
    private $runtime = null;

    /**
     * @property \MetadataV3\edm\Schema[] $dataServices
     */
    private $dataServices = null;

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
     * @return \MetadataV3\edmx\TDesignerType
     */
    public function getDesigner()
    {
        return $this->designer;
    }

    /**
     * Sets a new designer
     *
     * @param \MetadataV3\edmx\TDesignerType $designer
     * @return self
     */
    public function setDesigner(\MetadataV3\edmx\TDesignerType $designer)
    {
        $this->designer = $designer;
        return $this;
    }

    /**
     * Gets as runtime
     *
     * @return \MetadataV3\edmx\TRuntimeType
     */
    public function getRuntime()
    {
        return $this->runtime;
    }

    /**
     * Sets a new runtime
     *
     * @param \MetadataV3\edmx\TRuntimeType $runtime
     * @return self
     */
    public function setRuntime(\MetadataV3\edmx\TRuntimeType $runtime)
    {
        $this->runtime = $runtime;
        return $this;
    }

    /**
     * Adds as schema
     *
     * @return self
     * @param \MetadataV3\edm\Schema $schema
     */
    public function addToDataServices(\MetadataV3\edm\Schema $schema)
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
     * @return \MetadataV3\edm\Schema[]
     */
    public function getDataServices()
    {
        return $this->dataServices;
    }

    /**
     * Sets a new dataServices
     *
     * @param \MetadataV3\edm\Schema[] $dataServices
     * @return self
     */
    public function setDataServices(array $dataServices)
    {
        $this->dataServices = $dataServices;
        return $this;
    }
}
