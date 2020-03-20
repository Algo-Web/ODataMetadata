<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Expressions\Dynamic\TFunctionReferenceExpressionType;

use AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\CollectionType;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\ReferenceType;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\OtherTypeConstructs\RowType\Property;

/**
 * Class representing ParameterAType.
 */
class ParameterAType
{

    /**
     * @var string $type
     */
    private $type = null;

    /**
     * @var CollectionType[] $collectionType
     */
    private $collectionType = [
        
    ];

    /**
     * @var ReferenceType[] $referenceType
     */
    private $referenceType = [
        
    ];

    /**
     * @var Property[] $rowType
     */
    private $rowType = null;

    /**
     * Gets as type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets a new type.
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Adds as collectionType.
     *
     * @param CollectionType $collectionType
     *@return self
     */
    public function addToCollectionType(CollectionType $collectionType)
    {
        $this->collectionType[] = $collectionType;
        return $this;
    }

    /**
     * isset collectionType.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetCollectionType($index)
    {
        return isset($this->collectionType[$index]);
    }

    /**
     * unset collectionType.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetCollectionType($index)
    {
        unset($this->collectionType[$index]);
    }

    /**
     * Gets as collectionType.
     *
     * @return CollectionType[]
     */
    public function getCollectionType()
    {
        return $this->collectionType;
    }

    /**
     * Sets a new collectionType.
     *
     * @param  CollectionType[] $collectionType
     * @return self
     */
    public function setCollectionType(array $collectionType)
    {
        $this->collectionType = $collectionType;
        return $this;
    }

    /**
     * Adds as referenceType.
     *
     * @param ReferenceType $referenceType
     *@return self
     */
    public function addToReferenceType(ReferenceType $referenceType)
    {
        $this->referenceType[] = $referenceType;
        return $this;
    }

    /**
     * isset referenceType.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetReferenceType($index)
    {
        return isset($this->referenceType[$index]);
    }

    /**
     * unset referenceType.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetReferenceType($index)
    {
        unset($this->referenceType[$index]);
    }

    /**
     * Gets as referenceType.
     *
     * @return ReferenceType[]
     */
    public function getReferenceType()
    {
        return $this->referenceType;
    }

    /**
     * Sets a new referenceType.
     *
     * @param  ReferenceType[] $referenceType
     * @return self
     */
    public function setReferenceType(array $referenceType)
    {
        $this->referenceType = $referenceType;
        return $this;
    }

    /**
     * Adds as property.
     *
     * @param  Property $property
     * @return self
     */
    public function addToRowType(Property $property)
    {
        $this->rowType[] = $property;
        return $this;
    }

    /**
     * isset rowType.
     *
     * @param  int|string $index
     * @return bool
     */
    public function issetRowType($index)
    {
        return isset($this->rowType[$index]);
    }

    /**
     * unset rowType.
     *
     * @param  int|string $index
     * @return void
     */
    public function unsetRowType($index)
    {
        unset($this->rowType[$index]);
    }

    /**
     * Gets as rowType.
     *
     * @return Property[]
     */
    public function getRowType()
    {
        return $this->rowType;
    }

    /**
     * Sets a new rowType.
     *
     * @param  Property[] $rowType
     * @return self
     */
    public function setRowType(array $rowType)
    {
        $this->rowType = $rowType;
        return $this;
    }
}
