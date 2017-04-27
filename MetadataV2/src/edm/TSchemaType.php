<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\edm;

/**
 * Class representing TSchemaType
 *
 *
 * XSD Type: TSchema
 */
class TSchemaType
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
     * @property \MetadataV2\edm\TUsingType[] $using
     */
    private $using = array(
        
    );

    /**
     * @property \MetadataV2\edm\TAssociationType[] $association
     */
    private $association = array(
        
    );

    /**
     * @property \MetadataV2\edm\TComplexTypeType[] $complexType
     */
    private $complexType = array(
        
    );

    /**
     * @property \MetadataV2\edm\TEntityTypeType[] $entityType
     */
    private $entityType = array(
        
    );

    /**
     * @property \MetadataV2\edm\TFunctionType[] $function
     */
    private $function = array(
        
    );

    /**
     * @property \MetadataV2\edm\EntityContainer[] $entityContainer
     */
    private $entityContainer = array(
        
    );

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

    /**
     * Adds as using
     *
     * @return self
     * @param \MetadataV2\edm\TUsingType $using
     */
    public function addToUsing(\MetadataV2\edm\TUsingType $using)
    {
        $this->using[] = $using;
        return $this;
    }

    /**
     * isset using
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetUsing($index)
    {
        return isset($this->using[$index]);
    }

    /**
     * unset using
     *
     * @param scalar $index
     * @return void
     */
    public function unsetUsing($index)
    {
        unset($this->using[$index]);
    }

    /**
     * Gets as using
     *
     * @return \MetadataV2\edm\TUsingType[]
     */
    public function getUsing()
    {
        return $this->using;
    }

    /**
     * Sets a new using
     *
     * @param \MetadataV2\edm\TUsingType[] $using
     * @return self
     */
    public function setUsing(array $using)
    {
        $this->using = $using;
        return $this;
    }

    /**
     * Adds as association
     *
     * @return self
     * @param \MetadataV2\edm\TAssociationType $association
     */
    public function addToAssociation(\MetadataV2\edm\TAssociationType $association)
    {
        $this->association[] = $association;
        return $this;
    }

    /**
     * isset association
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetAssociation($index)
    {
        return isset($this->association[$index]);
    }

    /**
     * unset association
     *
     * @param scalar $index
     * @return void
     */
    public function unsetAssociation($index)
    {
        unset($this->association[$index]);
    }

    /**
     * Gets as association
     *
     * @return \MetadataV2\edm\TAssociationType[]
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Sets a new association
     *
     * @param \MetadataV2\edm\TAssociationType[] $association
     * @return self
     */
    public function setAssociation(array $association)
    {
        $this->association = $association;
        return $this;
    }

    /**
     * Adds as complexType
     *
     * @return self
     * @param \MetadataV2\edm\TComplexTypeType $complexType
     */
    public function addToComplexType(\MetadataV2\edm\TComplexTypeType $complexType)
    {
        $this->complexType[] = $complexType;
        return $this;
    }

    /**
     * isset complexType
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetComplexType($index)
    {
        return isset($this->complexType[$index]);
    }

    /**
     * unset complexType
     *
     * @param scalar $index
     * @return void
     */
    public function unsetComplexType($index)
    {
        unset($this->complexType[$index]);
    }

    /**
     * Gets as complexType
     *
     * @return \MetadataV2\edm\TComplexTypeType[]
     */
    public function getComplexType()
    {
        return $this->complexType;
    }

    /**
     * Sets a new complexType
     *
     * @param \MetadataV2\edm\TComplexTypeType[] $complexType
     * @return self
     */
    public function setComplexType(array $complexType)
    {
        $this->complexType = $complexType;
        return $this;
    }

    /**
     * Adds as entityType
     *
     * @return self
     * @param \MetadataV2\edm\TEntityTypeType $entityType
     */
    public function addToEntityType(\MetadataV2\edm\TEntityTypeType $entityType)
    {
        $this->entityType[] = $entityType;
        return $this;
    }

    /**
     * isset entityType
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetEntityType($index)
    {
        return isset($this->entityType[$index]);
    }

    /**
     * unset entityType
     *
     * @param scalar $index
     * @return void
     */
    public function unsetEntityType($index)
    {
        unset($this->entityType[$index]);
    }

    /**
     * Gets as entityType
     *
     * @return \MetadataV2\edm\TEntityTypeType[]
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * Sets a new entityType
     *
     * @param \MetadataV2\edm\TEntityTypeType[] $entityType
     * @return self
     */
    public function setEntityType(array $entityType)
    {
        $this->entityType = $entityType;
        return $this;
    }

    /**
     * Adds as function
     *
     * @return self
     * @param \MetadataV2\edm\TFunctionType $function
     */
    public function addToFunction(\MetadataV2\edm\TFunctionType $function)
    {
        $this->function[] = $function;
        return $this;
    }

    /**
     * isset function
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetFunction($index)
    {
        return isset($this->function[$index]);
    }

    /**
     * unset function
     *
     * @param scalar $index
     * @return void
     */
    public function unsetFunction($index)
    {
        unset($this->function[$index]);
    }

    /**
     * Gets as function
     *
     * @return \MetadataV2\edm\TFunctionType[]
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Sets a new function
     *
     * @param \MetadataV2\edm\TFunctionType[] $function
     * @return self
     */
    public function setFunction(array $function)
    {
        $this->function = $function;
        return $this;
    }

    /**
     * Adds as entityContainer
     *
     * @return self
     * @param \MetadataV2\edm\EntityContainer $entityContainer
     */
    public function addToEntityContainer(\MetadataV2\edm\EntityContainer $entityContainer)
    {
        $this->entityContainer[] = $entityContainer;
        return $this;
    }

    /**
     * isset entityContainer
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetEntityContainer($index)
    {
        return isset($this->entityContainer[$index]);
    }

    /**
     * unset entityContainer
     *
     * @param scalar $index
     * @return void
     */
    public function unsetEntityContainer($index)
    {
        unset($this->entityContainer[$index]);
    }

    /**
     * Gets as entityContainer
     *
     * @return \MetadataV2\edm\EntityContainer[]
     */
    public function getEntityContainer()
    {
        return $this->entityContainer;
    }

    /**
     * Sets a new entityContainer
     *
     * @param \MetadataV2\edm\EntityContainer[] $entityContainer
     * @return self
     */
    public function setEntityContainer(array $entityContainer)
    {
        $this->entityContainer = $entityContainer;
        return $this;
    }
}
