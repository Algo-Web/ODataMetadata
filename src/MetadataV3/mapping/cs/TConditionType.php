<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV4\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TConditionType
 *
 * Type for Condition Element
 *
 * XSD Type: TCondition
 */
class TConditionType extends IsOK
{
    use TSimpleIdentifierTrait;
    /**
     * @property string $value
     */
    private $value = null;

    /**
     * @property string $name
     */
    private $name = null;

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
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
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
        if (null != $this->name) {
            if (!$this->isStringNotNullOrEmpty($this->name)) {
                $msg = 'Name cannot be empty';
                return false;
            }
            if (!$this->isTSimpleIdentifierValid($this->name)) {
                $msg = 'Name must be a valid TSimpleIdentifier';
                return false;
            }
        }
        if (null != $this->columnName) {
            if (!$this->isStringNotNullOrEmpty($this->columnName)) {
                $msg = 'Column name cannot be empty';
                return false;
            }
        }
        if (null != $this->value) {
            if (!$this->isStringNotNullOrEmpty($this->value)) {
                $msg = 'Value cannot be empty';
                return false;
            }
        }
        return true;
    }
}
