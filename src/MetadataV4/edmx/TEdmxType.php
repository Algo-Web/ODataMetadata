<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edmx;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV4\edm\Schema;

/**
 * Class representing TEdmxType
 *
 * XSD Type: TEdmx
 */
class TEdmxType extends IsOK
{

    /**
     * @property float $version
     */
    private $version = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edmx\TReferenceType[] $reference
     */
    private $reference = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\Schema[] $dataServices
     */
    private $dataServices = null;

    /**
     * Gets as version
     *
     * @return float
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Sets a new version
     *
     * @param  float $version
     * @return self
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Adds as reference
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edmx\TReferenceType $reference
     */
    public function addToReference(TReferenceType $reference)
    {
        $this->reference[] = $reference;
        return $this;
    }

    /**
     * isset reference
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetReference($index)
    {
        return isset($this->reference[$index]);
    }

    /**
     * unset reference
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetReference($index)
    {
        unset($this->reference[$index]);
    }

    /**
     * Gets as reference
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edmx\TReferenceType[]
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Sets a new reference
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edmx\TReferenceType[] $reference
     * @return self
     */
    public function setReference(array $reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * Adds as schema
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Schema $schema
     */
    public function addToDataServices(Schema $schema)
    {
        $this->dataServices[] = $schema;
        return $this;
    }

    /**
     * isset dataServices
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetDataServices($index)
    {
        return isset($this->dataServices[$index]);
    }

    /**
     * unset dataServices
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetDataServices($index)
    {
        unset($this->dataServices[$index]);
    }

    /**
     * Gets as dataServices
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\Schema[]
     */
    public function getDataServices()
    {
        return $this->dataServices;
    }

    /**
     * Sets a new dataServices
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Schema[] $dataServices
     * @return self
     */
    public function setDataServices(array $dataServices)
    {
        $this->dataServices = $dataServices;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (is_null($this->version)) {
            $msg = "Edmx version can not be null";
            return false;
        }
        if (is_float($this->version)) {
            if (!$this->isValidArray($this->dataServices, '\AlgoWeb\ODataMetadata\MetadataV4\edm\Schema', 1)) {
                $msg = "Edmx dataservice definition contains invalid enteries.";
                return false;
            }
        }
        if (!$this->isValidArray($this->reference, '\AlgoWeb\ODataMetadata\MetadataV4\edmx\TReferenceType')) {
            $msg = "Edmx references contains invalid elements";
            return false;
        }
        if (!$this->isChildArrayOK($this->dataServices, $msg)) {
            return false;
        }
        if (!$this->isChildArrayOK($this->reference, $msg)) {
            return false;
        }
        return true;
    }
}
