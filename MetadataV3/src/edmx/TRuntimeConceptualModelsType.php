<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edmx;

/**
 * Class representing TRuntimeConceptualModelsType
 *
 *
 * XSD Type: TRuntimeConceptualModels
 */
class TRuntimeConceptualModelsType
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\Schema $schema
     */
    private $schema = null;

    /**
     * Gets as schema
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Sets a new schema
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\Schema $schema
     * @return self
     */
    public function setSchema(Schema $schema)
    {
        $this->schema = $schema;
        return $this;
    }
}
