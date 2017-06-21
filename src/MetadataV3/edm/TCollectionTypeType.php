<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\TFacetAttributesTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TUnwrappedFunctionTypeTrait;

/**
 * Class representing TCollectionTypeType
 *
 * XSD Type: TCollectionType
 */
class TCollectionTypeType extends IsOK
{
    use TFacetAttributesTrait, TUnwrappedFunctionTypeTrait;
    /**
     * @property string $elementType
     */
    private $elementType = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType $collectionType
     */
    private $collectionType = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType $referenceType
     */
    private $referenceType = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType[] $rowType
     */
    private $rowType = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeRefType $typeRef
     */
    private $typeRef = null;

    /**
     * Gets as elementType
     *
     * @return string
     */
    public function getElementType()
    {
        return $this->elementType;
    }

    /**
     * Sets a new elementType
     *
     * @param  string $elementType
     * @return self
     */
    public function setElementType($elementType)
    {
        if (null != $elementType && !$this->isTUnwrappedFunctionTypeValid($elementType)) {
            $msg = "Element type must be a valid TUnwrappedFunction";
            throw new \InvalidArgumentException($msg);
        }
        $this->elementType = $elementType;
        return $this;
    }

    /**
     * Gets as collectionType
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType
     */
    public function getCollectionType()
    {
        return $this->collectionType;
    }

    /**
     * Sets a new collectionType
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType $collectionType
     * @return self
     */
    public function setCollectionType(TCollectionTypeType $collectionType)
    {
        $msg = null;
        if (!$collectionType->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->collectionType = $collectionType;
        return $this;
    }

    /**
     * Gets as referenceType
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType
     */
    public function getReferenceType()
    {
        return $this->referenceType;
    }

    /**
     * Sets a new referenceType
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType $referenceType
     * @return self
     */
    public function setReferenceType(TReferenceTypeType $referenceType)
    {
        $msg = null;
        if (!$referenceType->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->referenceType = $referenceType;
        return $this;
    }

    /**
     * Adds as property
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType $property
     */
    public function addToRowType(TPropertyType $property)
    {
        $msg = null;
        if (!$property->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->rowType[] = $property;
        return $this;
    }

    /**
     * isset rowType
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetRowType($index)
    {
        return isset($this->rowType[$index]);
    }

    /**
     * unset rowType
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetRowType($index)
    {
        unset($this->rowType[$index]);
    }

    /**
     * Gets as rowType
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType[]
     */
    public function getRowType()
    {
        return $this->rowType;
    }

    /**
     * Sets a new rowType
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType[] $rowType
     * @return self
     */
    public function setRowType(array $rowType)
    {
        if (!$this->isValidArray($rowType, '\AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType', $msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->rowType = $rowType;
        return $this;
    }

    /**
     * Gets as typeRef
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeRefType
     */
    public function getTypeRef()
    {
        return $this->typeRef;
    }

    /**
     * Sets a new typeRef
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeRefType $typeRef
     * @return self
     */
    public function setTypeRef(TTypeRefType $typeRef)
    {
        $msg = null;
        if (!$typeRef->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->typeRef = $typeRef;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (null != $this->elementType && !$this->isTUnwrappedFunctionTypeValid($this->elementType)) {
            $msg = "Element type must be a valid TUnwrappedFunction";
            return false;
        }
        if (!$this->isTFacetAttributesTraitValid($msg)) {
            return false;
        }
        if (!$this->isObjectNullOrOK($this->collectionType, $msg)) {
            return false;
        }
        if (!$this->isObjectNullOrOK($this->referenceType, $msg)) {
            return false;
        }
        if (!$this->isValidArray($this->rowType, '\AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType', $msg)) {
            return false;
        }
        if (!$this->isObjectNullOrOK($this->typeRef, $msg)) {
            return false;
        }

        $count = (isset($this->collectionType) ? 1 : 0) + (isset($this->referenceType) ? 1 : 0)
                 + (0 < count($this->rowType) ? 1 : 0) + (isset($this->typeRef) ? 1 : 0);
        if (1 != $count) {
            $msg = "Exactly one of collection type and reference type must not be null";
            return false;
        }

        return true;
    }
}
