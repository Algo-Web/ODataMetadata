<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

/**
 * Class representing Schema
 */
class Schema extends TSchemaType
{
    public function __construct($namespace = "Data")
    {
        $this->setNamespace($namespace);
    }
}
