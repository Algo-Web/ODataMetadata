<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\edmx;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\Mapping;

/**
 * Class representing TRuntimeMappingsType
 *
 * XSD Type: TRuntimeMappings
 */
class TRuntimeMappingsType extends IsOK
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\Mapping $mapping
     */
    private $mapping = null;

    /**
     * Gets as mapping
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\Mapping
     */
    public function getMapping()
    {
        return $this->mapping;
    }

    /**
     * Sets a new mapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\Mapping $mapping
     * @return self
     */
    public function setMapping(Mapping $mapping)
    {
        $this->mapping = $mapping;
        return $this;
    }
}
