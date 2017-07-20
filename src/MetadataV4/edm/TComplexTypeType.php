<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TComplexTypeType.
 *
 * XSD Type: TComplexType
 */
class TComplexTypeType extends IsOK
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
     * @property bool $abstract
     */
    private $abstract = null;

    /**
     * @property bool $openType
     */
    private $openType = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TPropertyType[] $property
     */
    private $property = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TNavigationPropertyType[] $navigationProperty
     */
    private $navigationProperty = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $annotation
     */
    private $annotation = array();

    /**
     * Gets as name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name.
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
     * Gets as baseType.
     *
     * @return string
     */
    public function getBaseType()
    {
        return $this->baseType;
    }

    /**
     * Sets a new baseType.
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
     * Gets as abstract.
     *
     * @return bool
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Sets a new abstract.
     *
     * @param  bool $abstract
     * @return self
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
        return $this;
    }

    /**
     * Gets as openType.
     *
     * @return bool
     */
    public function getOpenType()
    {
        return $this->openType;
    }

    /**
     * Sets a new openType.
     *
     * @param  bool $openType
     * @return self
     */
    public function setOpenType($openType)
    {
        $this->openType = $openType;
        return $this;
    }

    /**
     * Adds as property.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TPropertyType $property
     * @return self
     */
    public function addToProperty(TPropertyType $property)
    {
        $this->property[] = $property;
        return $this;
    }

    /**
     * isset property.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetProperty($index)
    {
        return isset($this->property[$index]);
    }

    /**
     * unset property.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetProperty($index)
    {
        unset($this->property[$index]);
    }

    /**
     * Gets as property.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TPropertyType[]
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Sets a new property.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TPropertyType[] $property
     * @return self
     */
    public function setProperty(array $property)
    {
        $this->property = $property;
        return $this;
    }

    /**
     * Adds as navigationProperty.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TNavigationPropertyType $navigationProperty
     * @return self
     */
    public function addToNavigationProperty(TNavigationPropertyType $navigationProperty)
    {
        $this->navigationProperty[] = $navigationProperty;
        return $this;
    }

    /**
     * isset navigationProperty.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetNavigationProperty($index)
    {
        return isset($this->navigationProperty[$index]);
    }

    /**
     * unset navigationProperty.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetNavigationProperty($index)
    {
        unset($this->navigationProperty[$index]);
    }

    /**
     * Gets as navigationProperty.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TNavigationPropertyType[]
     */
    public function getNavigationProperty()
    {
        return $this->navigationProperty;
    }

    /**
     * Sets a new navigationProperty.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TNavigationPropertyType[] $navigationProperty
     * @return self
     */
    public function setNavigationProperty(array $navigationProperty)
    {
        $this->navigationProperty = $navigationProperty;
        return $this;
    }

    /**
     * Adds as annotation.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation $annotation
     * @return self
     */
    public function addToAnnotation(Annotation $annotation)
    {
        $this->annotation[] = $annotation;
        return $this;
    }

    /**
     * isset annotation.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetAnnotation($index)
    {
        return isset($this->annotation[$index]);
    }

    /**
     * unset annotation.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetAnnotation($index)
    {
        unset($this->annotation[$index]);
    }

    /**
     * Gets as annotation.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[]
     */
    public function getAnnotation()
    {
        return $this->annotation;
    }

    /**
     * Sets a new annotation.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $annotation
     * @return self
     */
    public function setAnnotation(array $annotation)
    {
        $this->annotation = $annotation;
        return $this;
    }
}
