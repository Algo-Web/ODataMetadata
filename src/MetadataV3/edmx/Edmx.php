<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edmx;

/**
 * Class representing Edmx
 */
class Edmx extends TEdmxType
{
    public function __construct($namespace = "Data", $EntityContainerName = "DefaultContainer", $version = "3.0")
    {
        $this->setVersion($version);
        $schema = new \AlgoWeb\ODataMetadata\MetadataV3\edm\Schema($namespace, $EntityContainerName);
        $dataService = new TDataServicesType('4.0' == $version ? '4.0' : '3.0', $version);
        $dataService->addToSchema($schema);
        $this->setDataServiceType($dataService);
    }
}
