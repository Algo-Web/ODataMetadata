<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GEmptyElementExtensibilityTrait;

/**
 * Class representing TUsingType
 *
 *
 * XSD Type: TUsing
 */
class TUsingType extends IsOK
{
    use GEmptyElementExtensibilityTrait;
    /**
     * @property string $namespace
     */
    private $namespace = null;

    /**
     * @property string $namespaceUri
     */
    private $namespaceUri = null;

    /**
     * @property string $alias
     */
    private $alias = null;

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
     * @param string $namespace
     * @return self
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * Gets as namespaceUri
     *
     * @return string
     */
    public function getNamespaceUri()
    {
        return $this->namespaceUri;
    }

    /**
     * Sets a new namespaceUri
     *
     * @param string $namespaceUri
     * @return self
     */
    public function setNamespaceUri($namespaceUri)
    {
        $this->namespaceUri = $namespaceUri;
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
     * @param string $alias
     * @return self
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isExtensibilityElementOK($msg)) {
            return false;
        }
        return true;
    }
}
