<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TWrappedFunctionTypeTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType;

/**
 * Class representing ParameterAnonymousType
 */
class ParameterAnonymousType extends IsOK
{
    use IsOKToolboxTrait, TWrappedFunctionTypeTrait;
    //Parameter is used to complete function signature: type only.

    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType[] $collectionType
     */
    private $collectionType = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType[] $referenceType
     */
    private $referenceType = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType[] $rowType
     */
    private $rowType = [];

    /**
     * Gets as type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets a new type
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        $msg = null;
        if (null != $type && !$this->isTWrappedFunctionTypeValid($type)) {
            $msg = "Type must be a valid TWrappedFunctionType";
            throw new \InvalidArgumentException($msg);
        }
        $this->type = $type;
        return $this;
    }

    /**
     * Adds as collectionType
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType $collectionType
     */
    public function addToCollectionType(TCollectionTypeType $collectionType)
    {
        $msg = null;
        if (!$collectionType->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->collectionType[] = $collectionType;
        return $this;
    }

    /**
     * isset collectionType
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetCollectionType($index)
    {
        return isset($this->collectionType[$index]);
    }

    /**
     * unset collectionType
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetCollectionType($index)
    {
        unset($this->collectionType[$index]);
    }

    /**
     * Gets as collectionType
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType[]
     */
    public function getCollectionType()
    {
        return $this->collectionType;
    }

    /**
     * Sets a new collectionType
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType[] $collectionType
     * @return self
     */
    public function setCollectionType(array $collectionType)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $collectionType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType',
            $msg,
            0,
            1
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->collectionType = $collectionType;
        return $this;
    }

    /**
     * Adds as referenceType
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType $referenceType
     */
    public function addToReferenceType(TReferenceTypeType $referenceType)
    {
        $msg = null;
        if (!$referenceType->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->referenceType[] = $referenceType;
        return $this;
    }

    /**
     * isset referenceType
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetReferenceType($index)
    {
        return isset($this->referenceType[$index]);
    }

    /**
     * unset referenceType
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetReferenceType($index)
    {
        unset($this->referenceType[$index]);
    }

    /**
     * Gets as referenceType
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType[]
     */
    public function getReferenceType()
    {
        return $this->referenceType;
    }

    /**
     * Sets a new referenceType
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType[] $referenceType
     * @return self
     */
    public function setReferenceType(array $referenceType)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $referenceType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType',
            $msg,
            0,
            1
        )
        ) {
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
        $msg = null;
        if (!$this->isValidArrayOK(
            $rowType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType',
            $msg,
            0,
            1
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->rowType = $rowType;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (null != $this->type && !$this->isTWrappedFunctionTypeValid($this->type)) {
            $msg = "Type must be a valid TWrappedFunctionType";
            return false;
        }

        if (!$this->isValidArrayOK(
            $this->collectionType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType',
            $msg,
            0,
            1
        )
        ) {
            return false;
        }

        if (!$this->isValidArrayOK(
            $this->referenceType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType',
            $msg,
            0,
            1
        )
        ) {
            return false;
        }

        if (!$this->isValidArrayOK(
            $this->rowType,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType',
            $msg,
            0,
            1
        )
        ) {
            return false;
        }

        $count = count($this->rowType) + count($this->referenceType) + count($this->collectionType);
        if (1 > $count) {
            $msg = "Only one component array can be non-empty, and that array must have no more than 1 element";
            return false;
        }

        return true;
    }
}
