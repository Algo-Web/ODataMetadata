<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TFunctionImportConditionType
 *
 * Type for FunctionImportMapping/Condition element
 *
 * XSD Type: TFunctionImportCondition
 */
class TFunctionImportConditionType extends IsOK
{

    /**
     * @property string $value
     */
    private $value = null;

    /**
     * @property string $columnName
     */
    private $columnName = null;

    /**
     * @property boolean $isNull
     */
    private $isNull = null;

    /**
     * Gets as value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets a new value
     *
     * @param  string $value
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Gets as columnName
     *
     * @return string
     */
    public function getColumnName()
    {
        return $this->columnName;
    }

    /**
     * Sets a new columnName
     *
     * @param  string $columnName
     * @return self
     */
    public function setColumnName($columnName)
    {
        if (!$this->isStringNotNullOrEmpty($columnName)) {
            $msg = 'Column name cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        $this->columnName = $columnName;
        return $this;
    }

    /**
     * Gets as isNull
     *
     * @return boolean
     */
    public function getIsNull()
    {
        return $this->isNull;
    }

    /**
     * Sets a new isNull
     *
     * @param  boolean $isNull
     * @return self
     */
    public function setIsNull($isNull)
    {
        $this->isNull = $isNull;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->columnName)) {
            $msg = 'Column name cannot be null or empty';
            return false;
        }
        return true;
    }
}
