<?php

namespace MetadataV3\edmx;

/**
 * Class representing TRuntimeType
 *
 *
 * XSD Type: TRuntime
 */
class TRuntimeType
{

    /**
     * @property \MetadataV3\edmx\TRuntimeStorageModelsType $storageModels
     */
    private $storageModels = null;

    /**
     * @property \MetadataV3\edmx\TRuntimeConceptualModelsType $conceptualModels
     */
    private $conceptualModels = null;

    /**
     * @property \MetadataV3\edmx\TRuntimeMappingsType $mappings
     */
    private $mappings = null;

    /**
     * Gets as storageModels
     *
     * @return \MetadataV3\edmx\TRuntimeStorageModelsType
     */
    public function getStorageModels()
    {
        return $this->storageModels;
    }

    /**
     * Sets a new storageModels
     *
     * @param \MetadataV3\edmx\TRuntimeStorageModelsType $storageModels
     * @return self
     */
    public function setStorageModels(\MetadataV3\edmx\TRuntimeStorageModelsType $storageModels)
    {
        $this->storageModels = $storageModels;
        return $this;
    }

    /**
     * Gets as conceptualModels
     *
     * @return \MetadataV3\edmx\TRuntimeConceptualModelsType
     */
    public function getConceptualModels()
    {
        return $this->conceptualModels;
    }

    /**
     * Sets a new conceptualModels
     *
     * @param \MetadataV3\edmx\TRuntimeConceptualModelsType $conceptualModels
     * @return self
     */
    public function setConceptualModels(\MetadataV3\edmx\TRuntimeConceptualModelsType $conceptualModels)
    {
        $this->conceptualModels = $conceptualModels;
        return $this;
    }

    /**
     * Gets as mappings
     *
     * @return \MetadataV3\edmx\TRuntimeMappingsType
     */
    public function getMappings()
    {
        return $this->mappings;
    }

    /**
     * Sets a new mappings
     *
     * @param \MetadataV3\edmx\TRuntimeMappingsType $mappings
     * @return self
     */
    public function setMappings(\MetadataV3\edmx\TRuntimeMappingsType $mappings)
    {
        $this->mappings = $mappings;
        return $this;
    }


}

