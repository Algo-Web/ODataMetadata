<?php

namespace MetadataV2\edmx;

/**
 * Class representing TRuntimeConceptualModelsType
 *
 *
 * XSD Type: TRuntimeConceptualModels
 */
class TRuntimeConceptualModelsType
{

    /**
     * @property \MetadataV2\edm\Schema $schema
     */
    private $schema = null;

    /**
     * Gets as schema
     *
     * @return \MetadataV2\edm\Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Sets a new schema
     *
     * @param \MetadataV2\edm\Schema $schema
     * @return self
     */
    public function setSchema(\MetadataV2\edm\Schema $schema)
    {
        $this->schema = $schema;
        return $this;
    }
}
