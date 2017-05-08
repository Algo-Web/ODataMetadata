<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edmx;

/**
 * Class representing Edmx
 */
class Edmx extends TEdmxType
{
    public function __construct($namespace = "Data", $EntityContainerName = "DefaultContainer", $version = "1.0")
    {
        $this->setVersion($version);
        $this->addToDataServices(new \AlgoWeb\ODataMetadata\MetadataV3\edm\Schema($namespace, $EntityContainerName));
    }
}
