<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
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
    use GSchemaBodyElementsTrait, TSimpleIdentifierTrait, XSDTopLevelTrait, TNamespaceNameTrait {
        TSimpleIdentifierTrait::isNCName insteadof TNamespaceNameTrait;
        TSimpleIdentifierTrait::matchesRegexPattern insteadof TNamespaceNameTrait;
        TSimpleIdentifierTrait::isName insteadof TNamespaceNameTrait;


    }
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
        if (null != $namespaceUri && !$this->isURLValid($namespaceUri)) {
            $msg = "Namespace url must be a valid url";
            throw new \InvalidArgumentException($msg);
        }
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
        if (null != $alias && !$this->isTSimpleIdentifierValid($alias)) {
            $msg = "Alias must be a valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->alias = $alias;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isTNamespaceNameValid($this->namespace)) {
            $msg = "Namespace must be a valid TNamespaceName";
            return false;
        }
        if (null != $this->namespaceUri && !$this->isURLValid($this->namespaceUri)) {
            $msg = "Namespace url must be a valid url";
            return false;
        }
        if (null != $this->alias && !$this->isTSimpleIdentifierValid($this->alias)) {
            $msg = "Alias must be a valid TSimpleIdentifier";
            return false;
        }
        if (!$this->isGSchemaBodyElementsValid($msg)) {
            return false;
        }
        return $this->isStructureOK($msg);
    }

    public function isStructureOK(&$msg = null)
    {
        $entityTypeNames = [];
        $this->getEntityType();
        foreach ($this->getEntityType() as $entityType) {
            $entityTypeNames[] = $entityType->getName();
        }

        $entitySets = $this->getEntityContainer()[0]->getEntitySet();
        foreach ($entitySets as $eset) {
            $eSetType = $eset->getEntityType();
            if (substr($eSetType, 0, strlen($this->getNamespace())) != $this->getNamespace()) {
                $msg = "Types for Entity Sets should have the namespace at the begnining " . __CLASS__;
                return false;
            }
            $eSetType = str_replace($this->getNamespace() . ".", "", $eSetType);
            if (!in_array($eSetType, $entityTypeNames)) {
                $msg = "entitySet Types should have a matching type name in entity Types";
                return false;
            }
            return true;
        }

    }

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
        if (!$this->isTNamespaceNameValid($namespace)) {
            $msg = "Namespace must be a valid TNamespaceName";
            throw new \InvalidArgumentException($msg);
        }
        $this->namespace = $namespace;
        return $this;
    }
}
