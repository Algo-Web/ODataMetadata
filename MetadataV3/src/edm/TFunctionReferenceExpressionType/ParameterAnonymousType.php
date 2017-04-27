<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType;

/**
 * Class representing ParameterAnonymousType
 */
class ParameterAnonymousType
{

    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property \MetadataV3\edm\TCollectionTypeType[] $collectionType
     */
    private $collectionType = array(
        
    );

    /**
     * @property \MetadataV3\edm\TReferenceTypeType[] $referenceType
     */
    private $referenceType = array(
        
    );

    /**
     * @property \MetadataV3\edm\TPropertyType[] $rowType
     */
    private $rowType = null;

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
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Adds as collectionType
     *
     * @return self
     * @param \MetadataV3\edm\TCollectionTypeType $collectionType
     */
    public function addToCollectionType(\MetadataV3\edm\TCollectionTypeType $collectionType)
    {
        $this->collectionType[] = $collectionType;
        return $this;
    }

    /**
     * isset collectionType
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetCollectionType($index)
    {
        return isset($this->collectionType[$index]);
    }

    /**
     * unset collectionType
     *
     * @param scalar $index
     * @return void
     */
    public function unsetCollectionType($index)
    {
        unset($this->collectionType[$index]);
    }

    /**
     * Gets as collectionType
     *
     * @return \MetadataV3\edm\TCollectionTypeType[]
     */
    public function getCollectionType()
    {
        return $this->collectionType;
    }

    /**
     * Sets a new collectionType
     *
     * @param \MetadataV3\edm\TCollectionTypeType[] $collectionType
     * @return self
     */
    public function setCollectionType(array $collectionType)
    {
        $this->collectionType = $collectionType;
        return $this;
    }

    /**
     * Adds as referenceType
     *
     * @return self
     * @param \MetadataV3\edm\TReferenceTypeType $referenceType
     */
    public function addToReferenceType(\MetadataV3\edm\TReferenceTypeType $referenceType)
    {
        $this->referenceType[] = $referenceType;
        return $this;
    }

    /**
     * isset referenceType
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetReferenceType($index)
    {
        return isset($this->referenceType[$index]);
    }

    /**
     * unset referenceType
     *
     * @param scalar $index
     * @return void
     */
    public function unsetReferenceType($index)
    {
        unset($this->referenceType[$index]);
    }

    /**
     * Gets as referenceType
     *
     * @return \MetadataV3\edm\TReferenceTypeType[]
     */
    public function getReferenceType()
    {
        return $this->referenceType;
    }

    /**
     * Sets a new referenceType
     *
     * @param \MetadataV3\edm\TReferenceTypeType[] $referenceType
     * @return self
     */
    public function setReferenceType(array $referenceType)
    {
        $this->referenceType = $referenceType;
        return $this;
    }

    /**
     * Adds as property
     *
     * @return self
     * @param \MetadataV3\edm\TPropertyType $property
     */
    public function addToRowType(\MetadataV3\edm\TPropertyType $property)
    {
        $this->rowType[] = $property;
        return $this;
    }

    /**
     * isset rowType
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetRowType($index)
    {
        return isset($this->rowType[$index]);
    }

    /**
     * unset rowType
     *
     * @param scalar $index
     * @return void
     */
    public function unsetRowType($index)
    {
        unset($this->rowType[$index]);
    }

    /**
     * Gets as rowType
     *
     * @return \MetadataV3\edm\TPropertyType[]
     */
    public function getRowType()
    {
        return $this->rowType;
    }

    /**
     * Sets a new rowType
     *
     * @param \MetadataV3\edm\TPropertyType[] $rowType
     * @return self
     */
    public function setRowType(array $rowType)
    {
        $this->rowType = $rowType;
        return $this;
    }
}
