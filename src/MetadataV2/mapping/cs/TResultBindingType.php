<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\mapping\cs;

/**
 * Class representing TResultBindingType
 *
 * XSD Type: TResultBinding
 */
class TResultBindingType extends IsOK
{

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
     * @param  string $columnName
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
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
