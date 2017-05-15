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
        $this->getEntityType();
        foreach ($this->getEntityType() as $entityType) {
            $entityTypeNames[] = $entityType->getName();
        }
        foreach ($this->association as $association) {
            $associationNames[] = $association->getName();
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
        $found = false;
        $namespaceLen = strlen($this->namespace);
        if (0 != $namespaceLen) {
            $namespaceLen++;
        }
        foreach ($this->association as $assocation) {
            foreach ($this->entityContainer->associationSet as $assocationSet) {
                if ($assocation->getName() == substr($assocationSet->association, $namespaceLen)) {
                    $aEnd1 = $assocationSet->getEnd()[0];
                    $aEnd2 = $assocationSet->getEnd()[1];
                    $asEnd1 = $assocationSet->getEnd()[0];
                    $asEnd2 = $assocationSet->getEnd()[1];
                    //== TRUE if $a and $b have the same key/value pairs.
                    //===TRUE if $a and $b have the same key/value pairs in the same order and of the same types.
                    if ([$aEnd1->getRole(), $aEnd2->getRole()] == [$asEnd1->getRole(), $asEnd2->getRole()]) {
                        $found = true;
                    }
                }
            }
            if (!$found) {
                $msg = "can not find assocationset with matching roles for assocation";
                return false;
            }
            $found = false;
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
