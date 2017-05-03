<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\TFacetAttributesTrait;

/**
 * Class representing TTypeAssertExpressionType
 *
 *
 * XSD Type: TTypeAssertExpression
 */
class TTypeAssertExpressionType extends IsOK
{
    use TFacetAttributesTrait;
    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType[] $operand
     */
    private $operand = [];

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
     * Adds as operand
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType $operand
     */
    public function addToOperand(TOperandType $operand)
    {
        $this->operand[] = $operand;
        return $this;
    }

    /**
     * isset operand
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetOperand($index)
    {
        return isset($this->operand[$index]);
    }

    /**
     * unset operand
     *
     * @param scalar $index
     * @return void
     */
    public function unsetOperand($index)
    {
        unset($this->operand[$index]);
    }

    /**
     * Gets as operand
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType[]
     */
    public function getOperand()
    {
        return $this->operand;
    }

    /**
     * Sets a new operand
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType[] $operand
     * @return self
     */
    public function setOperand(array $operand)
    {
        $this->operand = $operand;
        return $this;
    }

    /**
     * Adds as collectionType
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType $collectionType
     */
    public function addToCollectionType(TCollectionTypeType $collectionType)
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType[]
     */
    public function getCollectionType()
    {
        return $this->collectionType;
    }

    /**
     * Sets a new collectionType
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType[] $collectionType
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
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType $referenceType
     */
    public function addToReferenceType(TReferenceTypeType $referenceType)
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType[]
     */
    public function getReferenceType()
    {
        return $this->referenceType;
    }

    /**
     * Sets a new referenceType
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType[] $referenceType
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
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType $property
     */
    public function addToRowType(TPropertyType $property)
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType[]
     */
    public function getRowType()
    {
        return $this->rowType;
    }

    /**
     * Sets a new rowType
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType[] $rowType
     * @return self
     */
    public function setRowType(array $rowType)
    {
        $this->rowType = $rowType;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isTFacetAttributesTraitValid($msg)) {
            return false;
        }
        return true;
    }
}
