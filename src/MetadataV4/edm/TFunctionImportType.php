<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TFunctionImportType
 *
 * XSD Type: TFunctionImport
 */
class TFunctionImportType extends IsOK
{

    /**
     * @property string $function
     */
    private $function = null;

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $entitySet
     */
    private $entitySet = null;

    /**
     * @property boolean $includeInServiceDocument
     */
    private $includeInServiceDocument = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $annotation
     */
    private $annotation = array();

    /**
     * Gets as function
     *
     * @return string
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Sets a new function
     *
     * @param  string $function
     * @return self
     */
    public function setFunction($function)
    {
        $this->function = $function;
        return $this;
    }

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
     * Gets as entitySet
     *
     * @return string
     */
    public function getEntitySet()
    {
        return $this->entitySet;
    }

    /**
     * Sets a new entitySet
     *
     * @param  string $entitySet
     * @return self
     */
    public function setEntitySet($entitySet)
    {
        $this->entitySet = $entitySet;
        return $this;
    }

    /**
     * Gets as includeInServiceDocument
     *
     * @return boolean
     */
    public function getIncludeInServiceDocument()
    {
        return $this->includeInServiceDocument;
    }

    /**
     * Sets a new includeInServiceDocument
     *
     * @param  boolean $includeInServiceDocument
     * @return self
     */
    public function setIncludeInServiceDocument($includeInServiceDocument)
    {
        $this->includeInServiceDocument = $includeInServiceDocument;
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
