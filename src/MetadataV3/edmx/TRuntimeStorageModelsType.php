<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edmx;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TRuntimeStorageModelsType
 *
 * XSD Type: TRuntimeStorageModels
 */
class TRuntimeStorageModelsType extends IsOK
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\Schema $schema
     */
    private $schema = null;

    /**
     * Gets as schema
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Sets a new schema
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\Schema $schema
     * @return self
     */
    public function setSchema(\AlgoWeb\ODataMetadata\MetadataV3\edm\Ssdl\Schema $schema)
    {
        $msg = null;
        if (!$schema->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->schema = $schema;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (null != $this->schema && !$this->schema->isOK($msg)) {
            return false;
        }

        return true;
    }
}
