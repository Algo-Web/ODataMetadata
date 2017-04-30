<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TResultBindingType
 *
 *
 * XSD Type: TResultBinding
 */
class TResultBindingType extends IsOK
{
    use TSimpleIdentifierTrait;
    /**
     * @property string $columnName
     */
    private $columnName = null;

    /**
     * @property string $name
     */
    private $name = null;

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
     * @param string $columnName
     * @return self
     */
    public function setColumnName($columnName)
    {
        $this->columnName = $columnName;
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
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    protected function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->name)) {
            $msg = 'Name cannot be null or empty';
            return false;
        }
        if (!$this->isStringNotNullOrEmpty($this->columnName)) {
            $msg = 'Column name cannot be null or empty';
            return false;
        }
        if (!$this->isTSimpleIdentifierValid($this->name)) {
            $msg = 'Name must be a valid TSimpleIdentifier';
            return false;
        }
        return true;
    }
}
