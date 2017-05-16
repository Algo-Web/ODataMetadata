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
        $associationNames = [];
        $navigationProperties = [];
        $assocationSets = [];
        $namespaceLen = strlen($this->namespace);
        if (0 != $namespaceLen) {
            $namespaceLen++;
        }

        foreach ($this->getEntityType() as $entityType) {
            $entityTypeNames[] = $entityType->getName();
            foreach ($entityType->getNavigationProperty() as $navigationProperty) {
                $navigationProperties[substr($navigationProperty->getRelationship(), $namespaceLen)][] = $navigationProperty;
            }
        }

        foreach ($this->association as $association) {
            $associationNames[$association->getName()] = $association->getEnd();
        }
        foreach ($this->getEntityContainer()[0]->getAssociationSet as $assocationSet) {
            $assocationSets[substr($assocationSet->getAssociation(), $namespaceLen)] = $assocationSet->getEnd();
        }


        $entitySets = $this->getEntityContainer()[0]->getEntitySet();
        foreach ($entitySets as $eset) {
            $eSetType = $eset->getEntityType();
            /*if (substr($eSetType, 0, strlen($this->getNamespace())) != $this->getNamespace()) {
                $msg = "Types for Entity Sets should have the namespace at the beginning " . __CLASS__;
                die($this->getNamespace());
                return false;
            }*/
            $eSetType = str_replace($this->getNamespace() . ".", "", $eSetType);
            if (!in_array($eSetType, $entityTypeNames)) {
                $msg = "entitySet Types should have a matching type name in entity Types";
                return false;
            }
        }

        // Check Associations to assocationSets
        if (count($assocationSets) != count($associationNames)) {
            $msg = "we have " . count($assocationSets) . "assocation sets and " . count($associationNames) . " Assocations, they should be the same";
        }
        if (count($associationNames) * 2 < $navigationProperties) {
            $msg = "we have two many navigation propertys. should have no more then double the number of assocations.";
        }

        foreach ($associationNames as $assocationName => $assocationEnds) {
            if (!array_key_exists($assocationName, $assocationSets)) {
                $msg = "assocation " . $assocationName . " exists without matching assocationSet";
                return false;
            }

            if (!array_key_exists($assocationName, $navigationProperties)) {
                $msg = "assocation " . $assocationName . " exists without matching Natvigation Property";
                return false;
            }
            if (!in_array($assocationSets[$assocationName][0]->getName, [$assocationEnds[0]->getName, $assocationEnds[1]->getName])) {
                $msg = "assocation Set role " . $assocationSets[$assocationName][0]->getName . "lacks a matching property in the attached assocation";
                return false;
            }
            if (!in_array($assocationSets[$assocationName][1]->getName, [$assocationEnds[0]->getName, $assocationEnds[1]->getName])) {
                $msg = "assocation Set role " . $assocationSets[$assocationName][0]->getName . "lacks a matching property in the attached assocation";
                return false;
            }
        }
        return true;
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
