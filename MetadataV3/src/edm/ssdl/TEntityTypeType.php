<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

/**
 * Class representing TEntityTypeType
 *
 *
 * XSD Type: TEntityType
 */
class TEntityTypeType
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property \MetadataV3\edm\ssdl\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \MetadataV3\edm\ssdl\TPropertyRefType[] $key
     */
    private $key = null;

    /**
     * @property \MetadataV3\edm\ssdl\TEntityPropertyType[] $property
     */
    private $property = array(
        
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
     * Gets as documentation
     *
     * @return \MetadataV3\edm\ssdl\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param \MetadataV3\edm\ssdl\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(\MetadataV3\edm\ssdl\TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as propertyRef
     *
     * @return self
     * @param \MetadataV3\edm\ssdl\TPropertyRefType $propertyRef
     */
    public function addToKey(\MetadataV3\edm\ssdl\TPropertyRefType $propertyRef)
    {
        $this->key[] = $propertyRef;
        return $this;
    }

    /**
     * isset key
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetKey($index)
    {
        return isset($this->key[$index]);
    }

    /**
     * unset key
     *
     * @param scalar $index
     * @return void
     */
    public function unsetKey($index)
    {
        unset($this->key[$index]);
    }

    /**
     * Gets as key
     *
     * @return \MetadataV3\edm\ssdl\TPropertyRefType[]
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Sets a new key
     *
     * @param \MetadataV3\edm\ssdl\TPropertyRefType[] $key
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
     * @param \MetadataV3\edm\ssdl\TEntityPropertyType $property
     */
    public function addToProperty(\MetadataV3\edm\ssdl\TEntityPropertyType $property)
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
     * @return \MetadataV3\edm\ssdl\TEntityPropertyType[]
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Sets a new property
     *
     * @param \MetadataV3\edm\ssdl\TEntityPropertyType[] $property
     * @return self
     */
    public function setProperty(array $property)
    {
        $this->property = $property;
        return $this;
    }
}
