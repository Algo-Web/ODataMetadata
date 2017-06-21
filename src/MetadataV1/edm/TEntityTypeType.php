<?php

namespace AlgoWeb\ODataMetadata\MetadataV1\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TEntityTypeType
 *
 * XSD Type: TEntityType
 */
class TEntityTypeType extends IsOK
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $baseType
     */
    private $baseType = null;

    /**
     * @property boolean $abstract
     */
    private $abstract = null;

    /**
     * @property string $typeAccess
     */
    private $typeAccess = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\edm\TPropertyRefType[] $key
     */
    private $key = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\edm\TEntityPropertyType[] $property
     */
    private $property = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\edm\TNavigationPropertyType[] $navigationProperty
     */
    private $navigationProperty = array();

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as baseType
     *
     * @return string
     */
    public function getBaseType()
    {
        return $this->baseType;
    }

    /**
     * Sets a new baseType
     *
     * @param  string $baseType
     * @return self
     */
    public function setBaseType($baseType)
    {
        $this->baseType = $baseType;
        return $this;
    }

    /**
     * Gets as abstract
     *
     * @return boolean
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Sets a new abstract
     *
     * @param  boolean $abstract
     * @return self
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
        return $this;
    }

    /**
     * Gets as typeAccess
     *
     * @return string
     */
    public function getTypeAccess()
    {
        return $this->typeAccess;
    }

    /**
     * Sets a new typeAccess
     *
     * @param  string $typeAccess
     * @return self
     */
    public function setTypeAccess($typeAccess)
    {
        $this->typeAccess = $typeAccess;
        return $this;
    }

    /**
     * Gets as documentation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as propertyRef
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\TPropertyRefType $propertyRef
     */
    public function addToKey(TPropertyRefType $propertyRef)
    {
        $this->key[] = $propertyRef;
        return $this;
    }

    /**
     * isset key
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetKey($index)
    {
        return isset($this->key[$index]);
    }

    /**
     * unset key
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetKey($index)
    {
        unset($this->key[$index]);
    }

    /**
     * Gets as key
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\edm\TPropertyRefType[]
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Sets a new key
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\TPropertyRefType[] $key
     * @return self
     */
    public function setKey(array $key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Adds as property
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\TEntityPropertyType $property
     */
    public function addToProperty(TEntityPropertyType $property)
    {
        $this->property[] = $property;
        return $this;
    }

    /**
     * isset property
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetProperty($index)
    {
        return isset($this->property[$index]);
    }

    /**
     * unset property
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetProperty($index)
    {
        unset($this->property[$index]);
    }

    /**
     * Gets as property
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\edm\TEntityPropertyType[]
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Sets a new property
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\TEntityPropertyType[] $property
     * @return self
     */
    public function setProperty(array $property)
    {
        $this->property = $property;
        return $this;
    }

    /**
     * Adds as navigationProperty
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\TNavigationPropertyType $navigationProperty
     */
    public function addToNavigationProperty(TNavigationPropertyType $navigationProperty)
    {
        $this->navigationProperty[] = $navigationProperty;
        return $this;
    }

    /**
     * isset navigationProperty
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetNavigationProperty($index)
    {
        return isset($this->navigationProperty[$index]);
    }

    /**
     * unset navigationProperty
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetNavigationProperty($index)
    {
        unset($this->navigationProperty[$index]);
    }

    /**
     * Gets as navigationProperty
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\edm\TNavigationPropertyType[]
     */
    public function getNavigationProperty()
    {
        return $this->navigationProperty;
    }

    /**
     * Sets a new navigationProperty
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\TNavigationPropertyType[] $navigationProperty
     * @return self
     */
    public function setNavigationProperty(array $navigationProperty)
    {
        $this->navigationProperty = $navigationProperty;
        return $this;
    }
}
