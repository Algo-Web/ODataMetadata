<?php

namespace MetadataV2\edmx;

/**
 * Class representing TRuntimeStorageModelsType
 *
 *
 * XSD Type: TRuntimeStorageModels
 */
class TRuntimeStorageModelsType
{

    /**
     * @property \MetadataV2\edm\ssdl\Schema $schema
     */
    private $schema = null;

    /**
     * Gets as schema
     *
     * @return \MetadataV2\edm\ssdl\Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Sets a new schema
     *
     * @param \MetadataV2\edm\ssdl\Schema $schema
     * @return self
     */
    public function setSchema(\MetadataV2\edm\ssdl\Schema $schema)
    {
        $this->schema = $schema;
        return $this;
    }


}

