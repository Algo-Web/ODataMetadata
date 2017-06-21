<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\edmx;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TRuntimeConceptualModelsType
 *
 * XSD Type: TRuntimeConceptualModels
 */
class TRuntimeConceptualModelsType extends IsOK
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\edm\Schema $schema
     */
    private $schema = null;

    /**
     * Gets as schema
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\edm\Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Sets a new schema
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\edm\Schema $schema
     * @return self
     */
    public function setSchema(MetadataV2\edm\Schema $schema)
    {
        $this->schema = $schema;
        return $this;
    }
}
