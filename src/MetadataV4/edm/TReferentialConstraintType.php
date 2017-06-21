<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TReferentialConstraintType
 *
 * XSD Type: TReferentialConstraint
 */
class TReferentialConstraintType extends IsOK
{

    /**
     * @property string $property
     */
    private $property = null;

    /**
     * @property string $referencedProperty
     */
    private $referencedProperty = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $annotation
     */
    private $annotation = array();

    /**
     * Gets as property
     *
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Sets a new property
     *
     * @param  string $property
     * @return self
     */
    public function setProperty($property)
    {
        $this->property = $property;
        return $this;
    }

    /**
     * Gets as referencedProperty
     *
     * @return string
     */
    public function getReferencedProperty()
    {
        return $this->referencedProperty;
    }

    /**
     * Sets a new referencedProperty
     *
     * @param  string $referencedProperty
     * @return self
     */
    public function setReferencedProperty($referencedProperty)
    {
        $this->referencedProperty = $referencedProperty;
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
