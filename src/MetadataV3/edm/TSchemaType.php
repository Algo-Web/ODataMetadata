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
     * @param  string $namespaceUri
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
     * @param  string $alias
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
        $entityCount = max(1, count($this->entityType));
        $rand = $this->getRand();
        // done this way to enable die-roll to be mocked - don't know how to mock rand() directly
        // bolted this in to cut down O (N ** 2 ) time hit that eventuates when running in production
        if (1 < $entityCount * $rand) {
            return true;
        }
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
        $associationSets = [];
        $namespaceLen = strlen($this->namespace);
        if (0 != $namespaceLen) {
            $namespaceLen++;
        }

        foreach ($this->getEntityType() as $entityType) {
            $entityTypeNames[] = $entityType->getName();
            foreach ($entityType->getNavigationProperty() as $navigationProperty) {
                $navigationProperties[
                substr($navigationProperty->getRelationship(), $namespaceLen)
                ][] = $navigationProperty;
            }
        }

        foreach ($this->association as $association) {
            $associationNames[$association->getName()] = $association->getEnd();
        }
        foreach ($this->getEntityContainer()[0]->getAssociationSet() as $associationSet) {
            $associationSets[substr($associationSet->getAssociation(), $namespaceLen)] = $associationSet->getEnd();
        }

        $numDefaults = 0;
        foreach ($this->getEntityContainer() as $entity) {
            $isDefault = $entity->getIsDefaultEntityContainer();
            $numDefaults += $isDefault ? 1 : 0;
        }
        if (1 != $numDefaults) {
            $msg = "Exactly one entityContainer must be set as default container, actually have " . $numDefaults;
            return false;
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

        // Check Associations to associationSets
        if (count($associationSets) != count($associationNames)) {
            $msg = "we have " . count($associationSets) . "association sets and " . count($associationNames)
                    . " associations, they should be the same";
        }
        if (count($associationNames) * 2 < count($navigationProperties)) {
            $msg = "we have too many navigation properties. should have no more then double the"
                    ." number of associations.";
        }
        foreach ($associationNames as $associationName => $associationEnds) {
            if (!array_key_exists($associationName, $associationSets)) {
                $msg = "association " . $associationName . " exists without matching associationSet";
                return false;
            }

            if (!array_key_exists($associationName, $navigationProperties)) {
                $msg = "association " . $associationName . " exists without matching Natvigation Property";
                return false;
            }
            $roles = [$associationEnds[0]->getRole(), $associationEnds[1]->getRole()];
            if (!in_array($associationSets[$associationName][0]->getRole(), $roles)) {
                $msg = "association Set role " . $associationSets[$associationName][0]->getRole()
                        . "lacks a matching property in the attached association";
                return false;
            }
            if (!in_array($associationSets[$associationName][1]->getRole(), $roles)) {
                $msg = "association Set role " . $associationSets[$associationName][1]->getRole()
                        . "lacks a matching property in the attached association";
                return false;
            }
            foreach ($navigationProperties[$associationName] as $navProp) {
                if (!in_array($navProp->getToRole(), $roles)) {
                    $msg = "Navigation Property Role " . $navProp->getToRole()
                            . " lacks a matching Property in the assocation";
                    return false;
                }
                if (!in_array($navProp->getFromRole(), $roles)) {
                    $msg = "Navigation Property Role " .$navProp->getToRole()
                            . " lacks a matching Property in the assocation";
                    return false;
                }
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
     * @param  string $namespace
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

    public function getRand()
    {
        return rand() / getrandmax();
    }
}
