<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

/**
 * Class representing TComplexTypeType
 *
 *
 * XSD Type: TComplexType
 */
class TComplexTypeType
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $typeAccess
     */
    private $typeAccess = null;

    /**
     * @property \MetadataV3\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \MetadataV3\edm\TComplexTypePropertyType[] $property
     */
    private $property = array(
        
    );

    /**
     * @property \MetadataV3\edm\TValueAnnotationType[] $valueAnnotation
     */
    private $valueAnnotation = array(
        
    );

    /**
     * @property \MetadataV3\edm\TTypeAnnotationType[] $typeAnnotation
     */
    private $typeAnnotation = array(
        
    );

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
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @param string $typeAccess
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
     * @return \MetadataV3\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param \MetadataV3\edm\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(\MetadataV3\edm\TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as property
     *
     * @return self
     * @param \MetadataV3\edm\TComplexTypePropertyType $property
     */
    public function addToProperty(\MetadataV3\edm\TComplexTypePropertyType $property)
    {
        $this->property[] = $property;
        return $this;
    }

    /**
     * isset property
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetProperty($index)
    {
        return isset($this->property[$index]);
    }

    /**
     * unset property
     *
     * @param scalar $index
     * @return void
     */
    public function unsetProperty($index)
    {
        unset($this->property[$index]);
    }

    /**
     * Gets as property
     *
     * @return \MetadataV3\edm\TComplexTypePropertyType[]
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Sets a new property
     *
     * @param \MetadataV3\edm\TComplexTypePropertyType[] $property
     * @return self
     */
    public function setProperty(array $property)
    {
        $this->property = $property;
        return $this;
    }

    /**
     * Adds as valueAnnotation
     *
     * @return self
     * @param \MetadataV3\edm\TValueAnnotationType $valueAnnotation
     */
    public function addToValueAnnotation(\MetadataV3\edm\TValueAnnotationType $valueAnnotation)
    {
        $this->valueAnnotation[] = $valueAnnotation;
        return $this;
    }

    /**
     * isset valueAnnotation
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetValueAnnotation($index)
    {
        return isset($this->valueAnnotation[$index]);
    }

    /**
     * unset valueAnnotation
     *
     * @param scalar $index
     * @return void
     */
    public function unsetValueAnnotation($index)
    {
        unset($this->valueAnnotation[$index]);
    }

    /**
     * Gets as valueAnnotation
     *
     * @return \MetadataV3\edm\TValueAnnotationType[]
     */
    public function getValueAnnotation()
    {
        return $this->valueAnnotation;
    }

    /**
     * Sets a new valueAnnotation
     *
     * @param \MetadataV3\edm\TValueAnnotationType[] $valueAnnotation
     * @return self
     */
    public function setValueAnnotation(array $valueAnnotation)
    {
        $this->valueAnnotation = $valueAnnotation;
        return $this;
    }

    /**
     * Adds as typeAnnotation
     *
     * @return self
     * @param \MetadataV3\edm\TTypeAnnotationType $typeAnnotation
     */
    public function addToTypeAnnotation(\MetadataV3\edm\TTypeAnnotationType $typeAnnotation)
    {
        $this->typeAnnotation[] = $typeAnnotation;
        return $this;
    }

    /**
     * isset typeAnnotation
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetTypeAnnotation($index)
    {
        return isset($this->typeAnnotation[$index]);
    }

    /**
     * unset typeAnnotation
     *
     * @param scalar $index
     * @return void
     */
    public function unsetTypeAnnotation($index)
    {
        unset($this->typeAnnotation[$index]);
    }

    /**
     * Gets as typeAnnotation
     *
     * @return \MetadataV3\edm\TTypeAnnotationType[]
     */
    public function getTypeAnnotation()
    {
        return $this->typeAnnotation;
    }

    /**
     * Sets a new typeAnnotation
     *
     * @param \MetadataV3\edm\TTypeAnnotationType[] $typeAnnotation
     * @return self
     */
    public function setTypeAnnotation(array $typeAnnotation)
    {
        $this->typeAnnotation = $typeAnnotation;
        return $this;
    }
}
