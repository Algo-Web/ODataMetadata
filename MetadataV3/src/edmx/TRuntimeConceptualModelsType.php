<?php

namespace MetadataV3\edmx;

/**
 * Class representing TRuntimeConceptualModelsType
 *
 *
 * XSD Type: TRuntimeConceptualModels
 */
class TRuntimeConceptualModelsType
{

    /**
     * @property \MetadataV3\edm\Schema $schema
     */
    private $schema = null;

    /**
     * Gets as schema
     *
     * @return \MetadataV3\edm\Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Sets a new schema
     *
     * @param \MetadataV3\edm\Schema $schema
     * @return self
     */
    public function setSchema(\MetadataV3\edm\Schema $schema)
    {
        $this->schema = $schema;
        return $this;
    }


}

