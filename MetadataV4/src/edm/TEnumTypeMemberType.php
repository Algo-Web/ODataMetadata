<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm;

/**
 * Class representing TEnumTypeMemberType
 *
 *
 * XSD Type: TEnumTypeMember
 */
class TEnumTypeMemberType
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property integer $value
     */
    private $value = null;

    /**
     * @property \MetadataV4\edm\Annotation[] $annotation
     */
    private $annotation = array(
        
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
     * Gets as value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets a new value
     *
     * @param integer $value
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Adds as annotation
     *
     * @return self
     * @param \MetadataV4\edm\Annotation $annotation
     */
    public function addToAnnotation(\MetadataV4\edm\Annotation $annotation)
    {
        $this->annotation[] = $annotation;
        return $this;
    }

    /**
     * isset annotation
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetAnnotation($index)
    {
        return isset($this->annotation[$index]);
    }

    /**
     * unset annotation
     *
     * @param scalar $index
     * @return void
     */
    public function unsetAnnotation($index)
    {
        unset($this->annotation[$index]);
    }

    /**
     * Gets as annotation
     *
     * @return \MetadataV4\edm\Annotation[]
     */
    public function getAnnotation()
    {
        return $this->annotation;
    }

    /**
     * Sets a new annotation
     *
     * @param \MetadataV4\edm\Annotation[] $annotation
     * @return self
     */
    public function setAnnotation(array $annotation)
    {
        $this->annotation = $annotation;
        return $this;
    }
}
