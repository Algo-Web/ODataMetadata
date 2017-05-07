<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GSchemaBodyElementsTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TNamespaceNameTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;
use AlgoWeb\ODataMetadata\StringTraits\XSDTopLevelTrait;

/**
 * Class representing TSchemaType
 *
 *
 * XSD Type: TSchema
 */
class TSchemaType extends IsOK
{
    use IsOKToolboxTrait, GSchemaBodyElementsTrait, TSimpleIdentifierTrait, XSDTopLevelTrait, TNamespaceNameTrait;
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
        if (!$this->isTNamespaceNameValid($this->namespace)) {
            $msg = "Namespace must be a valid TNamespaceName";
            return false;
        }
        if (null != $this->alias && !$this->isTSimpleIdentifierValid($this->alias)) {
            $msg = "Alias must be a valid TSimpleIdentifier";
            return false;
        }
        if (null != $this->namespaceUri && !$this->isURLValid($this->namespaceUri)) {
            $msg = "Namespace url must be a valid url";
            return false;
        }
        if ($this->isGSchemaBodyElementsValid($msg)) {
            return false;
        }
        return true;
    }
}
