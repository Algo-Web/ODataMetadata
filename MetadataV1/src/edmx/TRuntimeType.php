<?php

namespace AlgoWeb\ODataMetadata\MetadataV1\edmx;

/**
 * Class representing TRuntimeType
 *
 *
 * XSD Type: TRuntime
 */
class TRuntimeType
{

    /**
     * @property \MetadataV1\edmx\TRuntimeStorageModelsType $storageModels
     */
    private $storageModels = null;

    /**
     * @property \MetadataV1\edmx\TRuntimeConceptualModelsType $conceptualModels
     */
    private $conceptualModels = null;

    /**
     * @property \MetadataV1\edmx\TRuntimeMappingsType $mappings
     */
    private $mappings = null;

    /**
     * Gets as storageModels
     *
     * @return \MetadataV1\edmx\TRuntimeStorageModelsType
     */
    public function getStorageModels()
    {
        return $this->storageModels;
    }

    /**
     * Sets a new storageModels
     *
     * @param \MetadataV1\edmx\TRuntimeStorageModelsType $storageModels
     * @return self
     */
    public function setStorageModels(\MetadataV1\edmx\TRuntimeStorageModelsType $storageModels)
    {
        $this->storageModels = $storageModels;
        return $this;
    }

    /**
     * Gets as conceptualModels
     *
     * @return \MetadataV1\edmx\TRuntimeConceptualModelsType
     */
    public function getConceptualModels()
    {
        return $this->conceptualModels;
    }

    /**
     * Sets a new conceptualModels
     *
     * @param \MetadataV1\edmx\TRuntimeConceptualModelsType $conceptualModels
     * @return self
     */
    public function setConceptualModels(\MetadataV1\edmx\TRuntimeConceptualModelsType $conceptualModels)
    {
        $this->conceptualModels = $conceptualModels;
        return $this;
    }

    /**
     * Gets as mappings
     *
     * @return \MetadataV1\edmx\TRuntimeMappingsType
     */
    public function getMappings()
    {
        return $this->mappings;
    }

    /**
     * Sets a new mappings
     *
     * @param \MetadataV1\edmx\TRuntimeMappingsType $mappings
     * @return self
     */
    public function setMappings(\MetadataV1\edmx\TRuntimeMappingsType $mappings)
    {
        $this->mappings = $mappings;
        return $this;
    }
}
