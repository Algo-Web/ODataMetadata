<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\CodeGeneration\AccessTypeTraits;
use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\TDerivableTypeAttributesTrait;

/**
 * Class representing TEntityTypeType
 *
 * XSD Type: TEntityType
 */
class TEntityTypeType extends IsOK
{
    use TDerivableTypeAttributesTrait, AccessTypeTraits;
    /**
     * @property boolean $openType
     */
    private $openType = false;

    /**
     * @property string $typeAccess
     */
    private $typeAccess = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType[] $key
     */
    private $key = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType[] $property
     */
    private $property = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TNavigationPropertyType[] $navigationProperty
     */
    private $navigationProperty = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType[] $valueAnnotation
     */
    private $valueAnnotation = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType[] $typeAnnotation
     */
    private $typeAnnotation = [];

    /**
     * Gets as openType
     *
     * @return boolean
     */
    public function getOpenType()
    {
        return $this->openType;
    }

    /**
     * Sets a new openType
     *
     * @param  boolean $openType
     * @return self
     */
    public function setOpenType($openType)
    {
        $this->openType = $openType;
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
        if (null != $typeAccess && !$this->isTPublicOrInternalAccessOK($typeAccess)) {
            $msg = "Type access must be Public or Internal";
            throw new \InvalidArgumentException($msg);
        }
        $this->typeAccess = $typeAccess;
        return $this;
    }

    /**
     * Gets as documentation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $msg = null;
        if (!$documentation->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as propertyRef
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType $propertyRef
     */
    public function addToKey(TPropertyRefType $propertyRef)
    {
        $msg = null;
        if (!$propertyRef->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType[]
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Sets a new key
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType[] $key
     * @return self
     */
    public function setKey(array $key)
    {
        if (!$this->isValidArrayOK(
            $key,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->key = $key;
        return $this;
    }

    /**
     * Adds as property
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType $property
     */
    public function addToProperty(TEntityPropertyType $property)
    {
        $msg = null;
        if (!$property->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
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
     * Adds as navigationProperty
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TNavigationPropertyType $navigationProperty
     */
    public function addToNavigationProperty(TNavigationPropertyType $navigationProperty)
    {
        $msg = null;
        if (!$navigationProperty->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
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
     * Adds as valueAnnotation
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType $valueAnnotation
     */
    public function addToValueAnnotation(TValueAnnotationType $valueAnnotation)
    {
        $msg = null;
        if (!$valueAnnotation->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->valueAnnotation[] = $valueAnnotation;
        return $this;
    }

    /**
     * isset valueAnnotation
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetValueAnnotation($index)
    {
        return isset($this->valueAnnotation[$index]);
    }

    /**
     * unset valueAnnotation
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetValueAnnotation($index)
    {
        unset($this->valueAnnotation[$index]);
    }

    /**
     * Gets as valueAnnotation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType[]
     */
    public function getValueAnnotation()
    {
        return $this->valueAnnotation;
    }

    /**
     * Sets a new valueAnnotation
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType[] $valueAnnotation
     * @return self
     */
    public function setValueAnnotation(array $valueAnnotation)
    {
        if (!$this->isValidArrayOK(
            $valueAnnotation,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->valueAnnotation = $valueAnnotation;
        return $this;
    }

    /**
     * Adds as typeAnnotation
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType $typeAnnotation
     */
    public function addToTypeAnnotation(TTypeAnnotationType $typeAnnotation)
    {
        $msg = null;
        if (!$typeAnnotation->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->typeAnnotation[] = $typeAnnotation;
        return $this;
    }

    /**
     * isset typeAnnotation
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetTypeAnnotation($index)
    {
        return isset($this->typeAnnotation[$index]);
    }

    /**
     * unset typeAnnotation
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetTypeAnnotation($index)
    {
        unset($this->typeAnnotation[$index]);
    }

    /**
     * Gets as typeAnnotation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType[]
     */
    public function getTypeAnnotation()
    {
        return $this->typeAnnotation;
    }

    /**
     * Sets a new typeAnnotation
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType[] $typeAnnotation
     * @return self
     */
    public function setTypeAnnotation(array $typeAnnotation)
    {
        if (!$this->isValidArrayOK(
            $typeAnnotation,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->typeAnnotation = $typeAnnotation;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (null != $this->typeAccess && !$this->isTPublicOrInternalAccessOK($this->typeAccess)) {
            $msg = "Type access must be Public or Internal";
            return false;
        }
        if (!$this->isObjectNullOrOK($this->documentation, $msg)) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->key,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType',
            $msg
        )
        ) {
            return false;
        }

        if (!$this->isValidArrayOK(
            $this->property,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType',
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->navigationProperty,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TNavigationPropertyType',
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->valueAnnotation,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType',
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->typeAnnotation,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType',
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isTDerivableTypeAttributesValid($msg)) {
            return false;
        }
        return $this->isStructureOK($msg);
    }

    public function isStructureOK(&$msg = null)
    {
        $pArray = [];
        foreach ($this->getProperty() as $prop) {
            if (in_array($prop->getName(), $pArray)) {
                $msg = "Property Names, and Navigation Property Must Be Unique " . __CLASS__;
                return false;
            }
            $pArray[] = $prop->getName();
        }
        foreach ($this->getNavigationProperty() as $prop) {
            if (in_array($prop->getName(), $pArray)) {
                $msg = "Property Names, and Navigation Property Must Be Unique " . __CLASS__;
                return false;
            }
            $pArray[] = $prop->getName();
        }
        if (in_array($this->getName(), $pArray)) {
            $msg = "entity types can not contain a property with the same name " . __CLASS__;
            return false;
        }
        return true;
    }

    /**
     * Gets as property
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType[]
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Sets a new property
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType[] $property
     * @return self
     */
    public function setProperty(array $property)
    {
        if (!$this->isValidArrayOK(
            $property,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->property = $property;
        return $this;
    }

    /**
     * Gets as navigationProperty
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TNavigationPropertyType[]
     */
    public function getNavigationProperty()
    {
        return $this->navigationProperty;
    }

    /**
     * Sets a new navigationProperty
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TNavigationPropertyType[] $navigationProperty
     * @return self
     */
    public function setNavigationProperty(array $navigationProperty)
    {
        if (!$this->isValidArrayOK(
            $navigationProperty,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TNavigationPropertyType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->navigationProperty = $navigationProperty;
        return $this;
    }
}
