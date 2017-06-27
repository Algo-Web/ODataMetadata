<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edmx;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Schema;

class TDataServicesType extends IsOK
{
    use IsOKToolboxTrait;
    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\Schema[] $schema
     */
    private $schema = [];

    /**
     * @property string $maxDataServiceVersion
     */
    private $maxDataServiceVersion;

    /**
     * @property string $dataServiceVersion
     */
    private $dataServiceVersion;

    public function __construct($maxDataServiceVersion = '3.0', $dataServiceVersion = '3.0')
    {
        if (!is_numeric($maxDataServiceVersion)) {
            $msg = "Maximum service version must be numeric";
            throw new \InvalidArgumentException($msg);
        }
        if (!is_numeric($dataServiceVersion)) {
            $msg = "Data service version must be numeric";
            throw new \InvalidArgumentException($msg);
        }

        if (floatval($maxDataServiceVersion) < floatval($dataServiceVersion)) {
            $msg = "Data service version cannot be greater than maximum service version";
            throw new \InvalidArgumentException($msg);
        }
        $this->setDataServiceVersion($dataServiceVersion);
        $this->setMaxDataServiceVersion($maxDataServiceVersion);
    }

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
     * @param  string $maxDataServiceVersion
     * @return self
     */
    public function setMaxDataServiceVersion($maxDataServiceVersion)
    {
        $maxDataValid = ['3.0', '4.0'];
        if (!in_array($maxDataServiceVersion, $maxDataValid)) {
            $msg = "Maximum data service version must be 3.0 or 4.0";
            throw new \InvalidArgumentException($msg);
        }
        $this->maxDataServiceVersion = $maxDataServiceVersion;
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
     * @param  string $dataServiceVersion
     * @return self
     */
    public function setDataServiceVersion($dataServiceVersion)
    {
        $dataValid = ['1.0', '2.0', '3.0', '4.0'];
        if (!in_array($dataServiceVersion, $dataValid)) {
            $msg = "Data service version must be 1.0, 2.0, 3.0 or 4.0";
            throw new \InvalidArgumentException($msg);
        }
        $this->dataServiceVersion = $dataServiceVersion;
        return $this;
    }
    /**
     * Adds as schema
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\Schema $schema
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
     * @param  scalar $index
     * @return boolean
     */
    public function issetSchema($index)
    {
        return isset($this->schema[$index]);
    }

    /**
     * unset schema
     *
     * @param  scalar $index
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
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\Schema[] $dataServices
     * @return self
     */
    public function setSchema(array $dataServices)
    {
        if (!$this->isValidArrayOK(
            $dataServices,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\Schema',
            $msg,
            1
        )
        ) {
            $msg = "Data services array not a valid array";
            throw new \InvalidArgumentException($msg);
        }
        $this->schema = $dataServices;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if ('3.0' == $this->maxDataServiceVersion && '4.0' == $this->dataServiceVersion) {
            $msg = "Data service version cannot be greater than maximum service version";
            return false;
        }

        if (!$this->isValidArrayOK($this->schema, '\AlgoWeb\ODataMetadata\MetadataV3\edm\Schema', $msg, 1)) {
            return false;
        }

        return true;
    }
}
