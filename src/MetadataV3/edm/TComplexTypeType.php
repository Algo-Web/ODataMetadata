<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\CodeGeneration\AccessTypeTraits;
use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\TTypeAttributesTrait;

/**
 * Class representing TComplexTypeType
 *
 * XSD Type: TComplexType
 */
class TComplexTypeType extends IsOK
{
    use TTypeAttributesTrait, AccessTypeTraits;

    /**
     * @property string $typeAccess
     */
    private $typeAccess = 'Public';

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypePropertyType[] $property
     */
    private $property = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType[] $valueAnnotation
     */
    private $valueAnnotation = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType[] $typeAnnotation
     */
    private $typeAnnotation = [];

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
        if (!$this->isTPublicOrInternalAccessOK($typeAccess)) {
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
     * Adds as property
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypePropertyType $property
     */
    public function addToProperty(TComplexTypePropertyType $property)
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
     * Gets as property
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypePropertyType[]
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Sets a new property
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypePropertyType[] $property
     * @return self
     */
    public function setProperty(array $property)
    {
        if (!$this->isValidArrayOK(
            $property,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypePropertyType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->property = $property;
        return $this;
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
        if (!$this->isTPublicOrInternalAccessOK($this->typeAccess)) {
            $msg = "Type access must be Public or Internal";
            return false;
        }
        if (!$this->isObjectNullOrOK($this->documentation, $msg)) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->property,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TComplexTypePropertyType',
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

        if (!$this->isTTypeAttributesValid($msg)) {
            return false;
        }
        return true;
    }
}
