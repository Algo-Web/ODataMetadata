<?php

namespace MetadataV1\edmx;

/**
 * Class representing TRuntimeConceptualModelsType
 *
 *
 * XSD Type: TRuntimeConceptualModels
 */
class TRuntimeConceptualModelsType
{

    /**
     * @property \MetadataV1\edm\Schema $schema
     */
    private $schema = null;

    /**
     * Gets as schema
     *
     * @return \MetadataV1\edm\Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Sets a new schema
     *
     * @param \MetadataV1\edm\Schema $schema
     * @return self
     */
    public function setSchema(\MetadataV1\edm\Schema $schema)
    {
        $this->schema = $schema;
        return $this;
    }
}
