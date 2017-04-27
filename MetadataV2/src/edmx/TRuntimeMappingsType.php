<?php

namespace MetadataV2\edmx;

/**
 * Class representing TRuntimeMappingsType
 *
 *
 * XSD Type: TRuntimeMappings
 */
class TRuntimeMappingsType
{

    /**
     * @property \MetadataV2\mapping\cs\Mapping $mapping
     */
    private $mapping = null;

    /**
     * Gets as mapping
     *
     * @return \MetadataV2\mapping\cs\Mapping
     */
    public function getMapping()
    {
        return $this->mapping;
    }

    /**
     * Sets a new mapping
     *
     * @param \MetadataV2\mapping\cs\Mapping $mapping
     * @return self
     */
    public function setMapping(\MetadataV2\mapping\cs\Mapping $mapping)
    {
        $this->mapping = $mapping;
        return $this;
    }
}
