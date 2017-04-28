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
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\Schema $schema
     */
    private $schema = null;

    /**
     * Gets as schema
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Sets a new schema
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\Schema $schema
     * @return self
     */
    public function setSchema(Ssdl\Schema $schema)
    {
        $this->schema = $schema;
        return $this;
    }
}
