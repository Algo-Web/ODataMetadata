<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edmx;

/**
 * Class representing TRuntimeStorageModelsType
 *
 *
 * XSD Type: TRuntimeStorageModels
 */
class TRuntimeStorageModelsType
{

    /**
     * @property \MetadataV3\edm\ssdl\Schema $schema
     */
    private $schema = null;

    /**
     * Gets as schema
     *
     * @return \MetadataV3\edm\ssdl\Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Sets a new schema
     *
     * @param \MetadataV3\edm\ssdl\Schema $schema
     * @return self
     */
    public function setSchema(\MetadataV3\edm\ssdl\Schema $schema)
    {
        $this->schema = $schema;
        return $this;
    }
}
