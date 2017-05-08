<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

/**
 * Class representing Schema
 */
class Schema extends TSchemaType
{
    public function __construct($namespace, $EntityContainerName)
    {
        $this->setNamespace($namespace);
        $this->addToEntityContainer(new EntityContainer($EntityContainerName));
    }
}
