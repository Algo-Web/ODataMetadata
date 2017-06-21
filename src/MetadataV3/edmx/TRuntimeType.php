<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edmx;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TRuntimeType
 *
 * XSD Type: TRuntime
 */
class TRuntimeType extends IsOK
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edmx\TRuntimeStorageModelsType $storageModels
     */
    private $storageModels = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edmx\TRuntimeConceptualModelsType $conceptualModels
     */
    private $conceptualModels = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edmx\TRuntimeMappingsType $mappings
     */
    private $mappings = null;

    /**
     * Gets as storageModels
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edmx\TRuntimeStorageModelsType
     */
    public function getStorageModels()
    {
        return $this->storageModels;
    }

    /**
     * Sets a new storageModels
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edmx\TRuntimeStorageModelsType $storageModels
     * @return self
     */
    public function setStorageModels(TRuntimeStorageModelsType $storageModels)
    {
        $msg = null;
        if (!$storageModels->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->storageModels = $storageModels;
        return $this;
    }

    /**
     * Gets as conceptualModels
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edmx\TRuntimeConceptualModelsType
     */
    public function getConceptualModels()
    {
        return $this->conceptualModels;
    }

    /**
     * Sets a new conceptualModels
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edmx\TRuntimeConceptualModelsType $conceptualModels
     * @return self
     */
    public function setConceptualModels(TRuntimeConceptualModelsType $conceptualModels)
    {
        $msg = null;
        if (!$conceptualModels->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->conceptualModels = $conceptualModels;
        return $this;
    }

    /**
     * Gets as mappings
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edmx\TRuntimeMappingsType
     */
    public function getMappings()
    {
        return $this->mappings;
    }

    /**
     * Sets a new mappings
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edmx\TRuntimeMappingsType $mappings
     * @return self
     */
    public function setMappings(TRuntimeMappingsType $mappings)
    {
        $msg = null;
        if (!$mappings->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->mappings = $mappings;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (null != $this->storageModels && !$this->storageModels->isOK($msg)) {
            return false;
        }
        if (null != $this->conceptualModels && !$this->conceptualModels->isOK($msg)) {
            return false;
        }
        if (null != $this->mappings && !$this->mappings->isOK($msg)) {
            return false;
        }

        return true;
    }
}
