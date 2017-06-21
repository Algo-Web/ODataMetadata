<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TEntityContainerType
 *
 * XSD Type: TEntityContainer
 */
class TEntityContainerType extends IsOK
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $extends
     */
    private $extends = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TEntitySetType[] $entitySet
     */
    private $entitySet = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TActionImportType[] $actionImport
     */
    private $actionImport = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TFunctionImportType[] $functionImport
     */
    private $functionImport = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TSingletonType[] $singleton
     */
    private $singleton = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $annotation
     */
    private $annotation = array();

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
     * Gets as extends
     *
     * @return string
     */
    public function getExtends()
    {
        return $this->extends;
    }

    /**
     * Sets a new extends
     *
     * @param  string $extends
     * @return self
     */
    public function setExtends($extends)
    {
        $this->extends = $extends;
        return $this;
    }

    /**
     * Adds as entitySet
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TEntitySetType $entitySet
     */
    public function addToEntitySet(TEntitySetType $entitySet)
    {
        $this->entitySet[] = $entitySet;
        return $this;
    }

    /**
     * isset entitySet
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetEntitySet($index)
    {
        return isset($this->entitySet[$index]);
    }

    /**
     * unset entitySet
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEntitySet($index)
    {
        unset($this->entitySet[$index]);
    }

    /**
     * Gets as entitySet
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TEntitySetType[]
     */
    public function getEntitySet()
    {
        return $this->entitySet;
    }

    /**
     * Sets a new entitySet
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TEntitySetType[] $entitySet
     * @return self
     */
    public function setEntitySet(array $entitySet)
    {
        $this->entitySet = $entitySet;
        return $this;
    }

    /**
     * Adds as actionImport
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TActionImportType $actionImport
     */
    public function addToActionImport(TActionImportType $actionImport)
    {
        $this->actionImport[] = $actionImport;
        return $this;
    }

    /**
     * isset actionImport
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetActionImport($index)
    {
        return isset($this->actionImport[$index]);
    }

    /**
     * unset actionImport
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetActionImport($index)
    {
        unset($this->actionImport[$index]);
    }

    /**
     * Gets as actionImport
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TActionImportType[]
     */
    public function getActionImport()
    {
        return $this->actionImport;
    }

    /**
     * Sets a new actionImport
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TActionImportType[] $actionImport
     * @return self
     */
    public function setActionImport(array $actionImport)
    {
        $this->actionImport = $actionImport;
        return $this;
    }

    /**
     * Adds as functionImport
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TFunctionImportType $functionImport
     */
    public function addToFunctionImport(TFunctionImportType $functionImport)
    {
        $this->functionImport[] = $functionImport;
        return $this;
    }

    /**
     * isset functionImport
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetFunctionImport($index)
    {
        return isset($this->functionImport[$index]);
    }

    /**
     * unset functionImport
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetFunctionImport($index)
    {
        unset($this->functionImport[$index]);
    }

    /**
     * Gets as functionImport
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TFunctionImportType[]
     */
    public function getFunctionImport()
    {
        return $this->functionImport;
    }

    /**
     * Sets a new functionImport
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TFunctionImportType[] $functionImport
     * @return self
     */
    public function setFunctionImport(array $functionImport)
    {
        $this->functionImport = $functionImport;
        return $this;
    }

    /**
     * Adds as singleton
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TSingletonType $singleton
     */
    public function addToSingleton(TSingletonType $singleton)
    {
        $this->singleton[] = $singleton;
        return $this;
    }

    /**
     * isset singleton
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetSingleton($index)
    {
        return isset($this->singleton[$index]);
    }

    /**
     * unset singleton
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetSingleton($index)
    {
        unset($this->singleton[$index]);
    }

    /**
     * Gets as singleton
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TSingletonType[]
     */
    public function getSingleton()
    {
        return $this->singleton;
    }

    /**
     * Sets a new singleton
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TSingletonType[] $singleton
     * @return self
     */
    public function setSingleton(array $singleton)
    {
        $this->singleton = $singleton;
        return $this;
    }

    /**
     * Adds as annotation
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation $annotation
     */
    public function addToAnnotation(Annotation $annotation)
    {
        $this->annotation[] = $annotation;
        return $this;
    }

    /**
     * isset annotation
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetAnnotation($index)
    {
        return isset($this->annotation[$index]);
    }

    /**
     * unset annotation
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetAnnotation($index)
    {
        unset($this->annotation[$index]);
    }

    /**
     * Gets as annotation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[]
     */
    public function getAnnotation()
    {
        return $this->annotation;
    }

    /**
     * Sets a new annotation
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
