<?php

namespace MetadataV3\edmx;

/**
 * Class representing TRuntimeMappingsType
 *
 *
 * XSD Type: TRuntimeMappings
 */
class TRuntimeMappingsType
{

    /**
     * @property \MetadataV3\mapping\cs\Mapping $mapping
     */
    private $mapping = null;

    /**
     * Gets as mapping
     *
     * @return \MetadataV3\mapping\cs\Mapping
     */
    public function getMapping()
    {
        return $this->mapping;
    }

    /**
     * Sets a new mapping
     *
     * @param \MetadataV3\mapping\cs\Mapping $mapping
     * @return self
     */
    public function setMapping(\MetadataV3\mapping\cs\Mapping $mapping)
    {
        $this->mapping = $mapping;
        return $this;
    }


}

