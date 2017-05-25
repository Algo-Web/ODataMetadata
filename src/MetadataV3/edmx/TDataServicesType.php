<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edmx;

class TDataServicesType
{
    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\Schema[] $dataServices
     */
    private $schema = [];

    /**
     * @property string $designer
     */
    private $maxDataServiceVersion;

    /**
     * @property string $designer
     */
    private $dataServiceVersion;

    /**
     * Gets as MaxDataServiceVersion
     *
     * @return string
     */
    public function getMaxDataServiceVersion()
    {
        return $this->maxDataServiceVersion;
    }

    /**
     * Sets a new DataServiceVersion
     *
     * @param string maxDataServiceVersion
     * @return self
     */
    public function setMaxDataServiceVersion($maxDataServiceVersion)
    {
        $this->designer = $maxDataServiceVersion;
        return $this;
    }

    /**
     * Gets as DataServiceVersion
     *
     * @return string
     */
    public function getDataServiceVersion()
    {
        return $this->dataServiceVersion;
    }

    /**
     * Sets a new DataServiceVersion
     *
     * @param string DataServiceVersion
     * @return self
     */
    public function setDataServiceVersion($dataServiceVersion)
    {
        $this->designer = $dataServiceVersion;
        return $this;
    }
    /**
     * Adds as schema
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\Schema $schema
     */
    public function addToSchema(Schema $schema)
    {
        $msg = null;
        if (!$schema->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->schema[] = $schema;
        return $this;
    }

    /**
     * isset schema
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetSchema($index)
    {
        return isset($this->schema[$index]);
    }

    /**
     * unset schema
     *
     * @param scalar $index
     * @return void
     */
    public function unsetSchema($index)
    {
        unset($this->schema[$index]);
    }

    /**
     * Gets as schema
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\Schema[]
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Sets a new schema
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\Schema[] $dataServices
     * @return self
     */
    public function setSchema(array $dataServices)
    {
        if (!$this->isValidArrayOK(
            $dataServices,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\Schema'
        )) {
            $msg = "Data services array not a valid array";
            throw new \InvalidArgumentException($msg);
        }
        $this->dataServices = $dataServices;
        return $this;
    }
}
