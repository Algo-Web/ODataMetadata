<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\edmx;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV2\edm\ssdl\Schema;

/**
 * Class representing TRuntimeStorageModelsType
 *
 * XSD Type: TRuntimeStorageModels
 */
class TRuntimeStorageModelsType extends IsOK
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\edm\ssdl\Schema $schema
     */
    private $schema = null;

    /**
     * Gets as schema
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\edm\ssdl\Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Sets a new schema
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\edm\ssdl\Schema $schema
     * @return self
     */
    public function setSchema(Schema $schema)
    {
        $this->schema = $schema;
        return $this;
    }
}
