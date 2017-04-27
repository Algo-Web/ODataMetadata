<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

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
     * @property string $namespaceUri
     */
    private $namespaceUri = null;

    /**
     * @property string $alias
     */
    private $alias = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TUsingType[] $using
     */
    private $using = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationType[] $association
     */
    private $association = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypeType[] $complexType
     */
    private $complexType = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType[] $entityType
     */
    private $entityType = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeType[] $enumType
     */
    private $enumType = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermType[] $valueTerm
     */
    private $valueTerm = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionType[] $function
     */
    private $function = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TAnnotationsType[] $annotations
     */
    private $annotations = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer[] $entityContainer
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

    /**
     * Adds as using
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TUsingType $using
     */
    public function addToUsing(TUsingType $using)
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TUsingType[]
     */
    public function getUsing()
    {
        return $this->using;
    }

    /**
     * Sets a new using
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TUsingType[] $using
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
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationType $association
     */
    public function addToAssociation(TAssociationType $association)
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationType[]
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Sets a new association
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationType[] $association
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
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypeType $complexType
     */
    public function addToComplexType(TComplexTypeType $complexType)
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypeType[]
     */
    public function getComplexType()
    {
        return $this->complexType;
    }

    /**
     * Sets a new complexType
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypeType[] $complexType
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
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType $entityType
     */
    public function addToEntityType(TEntityTypeType $entityType)
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType[]
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * Sets a new entityType
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityTypeType[] $entityType
     * @return self
     */
    public function setEntityType(array $entityType)
    {
        $this->entityType = $entityType;
        return $this;
    }

    /**
     * Adds as enumType
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeType $enumType
     */
    public function addToEnumType(TEnumTypeType $enumType)
    {
        $this->enumType[] = $enumType;
        return $this;
    }

    /**
     * isset enumType
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetEnumType($index)
    {
        return isset($this->enumType[$index]);
    }

    /**
     * unset enumType
     *
     * @param scalar $index
     * @return void
     */
    public function unsetEnumType($index)
    {
        unset($this->enumType[$index]);
    }

    /**
     * Gets as enumType
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeType[]
     */
    public function getEnumType()
    {
        return $this->enumType;
    }

    /**
     * Sets a new enumType
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeType[] $enumType
     * @return self
     */
    public function setEnumType(array $enumType)
    {
        $this->enumType = $enumType;
        return $this;
    }

    /**
     * Adds as valueTerm
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermType $valueTerm
     */
    public function addToValueTerm(TValueTermType $valueTerm)
    {
        $this->valueTerm[] = $valueTerm;
        return $this;
    }

    /**
     * isset valueTerm
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetValueTerm($index)
    {
        return isset($this->valueTerm[$index]);
    }

    /**
     * unset valueTerm
     *
     * @param scalar $index
     * @return void
     */
    public function unsetValueTerm($index)
    {
        unset($this->valueTerm[$index]);
    }

    /**
     * Gets as valueTerm
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermType[]
     */
    public function getValueTerm()
    {
        return $this->valueTerm;
    }

    /**
     * Sets a new valueTerm
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermType[] $valueTerm
     * @return self
     */
    public function setValueTerm(array $valueTerm)
    {
        $this->valueTerm = $valueTerm;
        return $this;
    }

    /**
     * Adds as function
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionType $function
     */
    public function addToFunction(TFunctionType $function)
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionType[]
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Sets a new function
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionType[] $function
     * @return self
     */
    public function setFunction(array $function)
    {
        $this->function = $function;
        return $this;
    }

    /**
     * Adds as annotations
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TAnnotationsType $annotations
     */
    public function addToAnnotations(TAnnotationsType $annotations)
    {
        $this->annotations[] = $annotations;
        return $this;
    }

    /**
     * isset annotations
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetAnnotations($index)
    {
        return isset($this->annotations[$index]);
    }

    /**
     * unset annotations
     *
     * @param scalar $index
     * @return void
     */
    public function unsetAnnotations($index)
    {
        unset($this->annotations[$index]);
    }

    /**
     * Gets as annotations
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TAnnotationsType[]
     */
    public function getAnnotations()
    {
        return $this->annotations;
    }

    /**
     * Sets a new annotations
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TAnnotationsType[] $annotations
     * @return self
     */
    public function setAnnotations(array $annotations)
    {
        $this->annotations = $annotations;
        return $this;
    }

    /**
     * Adds as entityContainer
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer $entityContainer
     */
    public function addToEntityContainer(EntityContainer $entityContainer)
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer[]
     */
    public function getEntityContainer()
    {
        return $this->entityContainer;
    }

    /**
     * Sets a new entityContainer
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer[] $entityContainer
     * @return self
     */
    public function setEntityContainer(array $entityContainer)
    {
        $this->entityContainer = $entityContainer;
        return $this;
    }
}
