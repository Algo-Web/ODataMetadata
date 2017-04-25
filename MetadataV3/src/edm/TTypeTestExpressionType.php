<?php

namespace MetadataV3\edm;

/**
 * Class representing TTypeTestExpressionType
 *
 *
 * XSD Type: TTypeTestExpression
 */
class TTypeTestExpressionType
{

    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property boolean $nullable
     */
    private $nullable = null;

    /**
     * @property string $defaultValue
     */
    private $defaultValue = null;

    /**
     * @property string $maxLength
     */
    private $maxLength = null;

    /**
     * @property boolean $fixedLength
     */
    private $fixedLength = null;

    /**
     * @property integer $precision
     */
    private $precision = null;

    /**
     * @property integer $scale
     */
    private $scale = null;

    /**
     * @property boolean $unicode
     */
    private $unicode = null;

    /**
     * @property string $collation
     */
    private $collation = null;

    /**
     * @property string $sRID
     */
    private $sRID = null;

    /**
     * @property \MetadataV3\edm\TOperandType[] $operand
     */
    private $operand = array(
        
    );

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
     * Gets as nullable
     *
     * @return boolean
     */
    public function getNullable()
    {
        return $this->nullable;
    }

    /**
     * Sets a new nullable
     *
     * @param boolean $nullable
     * @return self
     */
    public function setNullable($nullable)
    {
        $this->nullable = $nullable;
        return $this;
    }

    /**
     * Gets as defaultValue
     *
     * @return string
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * Sets a new defaultValue
     *
     * @param string $defaultValue
     * @return self
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

    /**
     * Gets as maxLength
     *
     * @return string
     */
    public function getMaxLength()
    {
        return $this->maxLength;
    }

    /**
     * Sets a new maxLength
     *
     * @param string $maxLength
     * @return self
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;
        return $this;
    }

    /**
     * Gets as fixedLength
     *
     * @return boolean
     */
    public function getFixedLength()
    {
        return $this->fixedLength;
    }

    /**
     * Sets a new fixedLength
     *
     * @param boolean $fixedLength
     * @return self
     */
    public function setFixedLength($fixedLength)
    {
        $this->fixedLength = $fixedLength;
        return $this;
    }

    /**
     * Gets as precision
     *
     * @return integer
     */
    public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * Sets a new precision
     *
     * @param integer $precision
     * @return self
     */
    public function setPrecision($precision)
    {
        $this->precision = $precision;
        return $this;
    }

    /**
     * Gets as scale
     *
     * @return integer
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * Sets a new scale
     *
     * @param integer $scale
     * @return self
     */
    public function setScale($scale)
    {
        $this->scale = $scale;
        return $this;
    }

    /**
     * Gets as unicode
     *
     * @return boolean
     */
    public function getUnicode()
    {
        return $this->unicode;
    }

    /**
     * Sets a new unicode
     *
     * @param boolean $unicode
     * @return self
     */
    public function setUnicode($unicode)
    {
        $this->unicode = $unicode;
        return $this;
    }

    /**
     * Gets as collation
     *
     * @return string
     */
    public function getCollation()
    {
        return $this->collation;
    }

    /**
     * Sets a new collation
     *
     * @param string $collation
     * @return self
     */
    public function setCollation($collation)
    {
        $this->collation = $collation;
        return $this;
    }

    /**
     * Gets as sRID
     *
     * @return string
     */
    public function getSRID()
    {
        return $this->sRID;
    }

    /**
     * Sets a new sRID
     *
     * @param string $sRID
     * @return self
     */
    public function setSRID($sRID)
    {
        $this->sRID = $sRID;
        return $this;
    }

    /**
     * Adds as operand
     *
     * @return self
     * @param \MetadataV3\edm\TOperandType $operand
     */
    public function addToOperand(\MetadataV3\edm\TOperandType $operand)
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
     * @return \MetadataV3\edm\TOperandType[]
     */
    public function getOperand()
    {
        return $this->operand;
    }

    /**
     * Sets a new operand
     *
     * @param \MetadataV3\edm\TOperandType[] $operand
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

