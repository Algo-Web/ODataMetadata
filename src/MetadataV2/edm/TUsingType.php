<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TUsingType
 *
 * XSD Type: TUsing
 */
class TUsingType extends IsOK
{

    /**
     * @property string $namespace
     */
    private $namespace = null;

    /**
     * @property string $alias
     */
    private $alias = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * Gets as namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Sets a new namespace
     *
     * @param  string $namespace
     * @return self
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * Gets as alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Sets a new alias
     *
     * @param  string $alias
     * @return self
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * Gets as documentation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\edm\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }
}
