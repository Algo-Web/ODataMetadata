<?php

namespace AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TSchemaType
 *
 * XSD Type: TSchema
 */
class TSchemaType extends IsOK
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
     * @property string $provider
     */
    private $provider = null;

    /**
     * @property string $providerManifestToken
     */
    private $providerManifestToken = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TAssociationType[] $association
     */
    private $association = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TEntityTypeType[] $entityType
     */
    private $entityType = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\EntityContainer[] $entityContainer
     */
    private $entityContainer = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TFunctionType[] $function
     */
    private $function = array();

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
     * Gets as provider
     *
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Sets a new provider
     *
     * @param  string $provider
     * @return self
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * Gets as providerManifestToken
     *
     * @return string
     */
    public function getProviderManifestToken()
    {
        return $this->providerManifestToken;
    }

    /**
     * Sets a new providerManifestToken
     *
     * @param  string $providerManifestToken
     * @return self
     */
    public function setProviderManifestToken($providerManifestToken)
    {
        $this->providerManifestToken = $providerManifestToken;
        return $this;
    }

    /**
     * Adds as association
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TAssociationType $association
     */
    public function addToAssociation(TAssociationType $association)
    {
        $this->association[] = $association;
        return $this;
    }

    /**
     * isset association
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetAssociation($index)
    {
        return isset($this->association[$index]);
    }

    /**
     * unset association
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetAssociation($index)
    {
        unset($this->association[$index]);
    }

    /**
     * Gets as association
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TAssociationType[]
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Sets a new association
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TAssociationType[] $association
     * @return self
     */
    public function setAssociation(array $association)
    {
        $this->association = $association;
        return $this;
    }

    /**
     * Adds as entityType
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TEntityTypeType $entityType
     */
    public function addToEntityType(TEntityTypeType $entityType)
    {
        $this->entityType[] = $entityType;
        return $this;
    }

    /**
     * isset entityType
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetEntityType($index)
    {
        return isset($this->entityType[$index]);
    }

    /**
     * unset entityType
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEntityType($index)
    {
        unset($this->entityType[$index]);
    }

    /**
     * Gets as entityType
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TEntityTypeType[]
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * Sets a new entityType
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TEntityTypeType[] $entityType
     * @return self
     */
    public function setEntityType(array $entityType)
    {
        $this->entityType = $entityType;
        return $this;
    }

    /**
     * Adds as entityContainer
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\EntityContainer $entityContainer
     */
    public function addToEntityContainer(EntityContainer $entityContainer)
    {
        $this->entityContainer[] = $entityContainer;
        return $this;
    }

    /**
     * isset entityContainer
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetEntityContainer($index)
    {
        return isset($this->entityContainer[$index]);
    }

    /**
     * unset entityContainer
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEntityContainer($index)
    {
        unset($this->entityContainer[$index]);
    }

    /**
     * Gets as entityContainer
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\EntityContainer[]
     */
    public function getEntityContainer()
    {
        return $this->entityContainer;
    }

    /**
     * Sets a new entityContainer
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\EntityContainer[] $entityContainer
     * @return self
     */
    public function setEntityContainer(array $entityContainer)
    {
        $this->entityContainer = $entityContainer;
        return $this;
    }

    /**
     * Adds as function
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TFunctionType $function
     */
    public function addToFunction(TFunctionType $function)
    {
        $this->function[] = $function;
        return $this;
    }

    /**
     * isset function
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetFunction($index)
    {
        return isset($this->function[$index]);
    }

    /**
     * unset function
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetFunction($index)
    {
        unset($this->function[$index]);
    }

    /**
     * Gets as function
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TFunctionType[]
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Sets a new function
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TFunctionType[] $function
     * @return self
     */
    public function setFunction(array $function)
    {
        $this->function = $function;
        return $this;
    }
}
