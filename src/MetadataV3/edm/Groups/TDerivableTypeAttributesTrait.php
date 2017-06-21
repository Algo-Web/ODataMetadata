<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Groups;

use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TQualifiedNameTrait;

trait TDerivableTypeAttributesTrait
{
    use TQualifiedNameTrait, TTypeAttributesTrait {
        TQualifiedNameTrait::isNCName insteadof TTypeAttributesTrait;
        TQualifiedNameTrait::matchesRegexPattern insteadof TTypeAttributesTrait;
        TQualifiedNameTrait::isName insteadof TTypeAttributesTrait;
    }
    /**
     * @property string $baseType
     */
    private $baseType = null;

    /**
     * @property boolean $abstract
     */
    private $abstract = false;

    /**
     * Gets as baseType
     *
     * @return string
     */
    public function getBaseType()
    {
        return $this->baseType;
    }

    /**
     * Sets a new baseType
     *
     * @param  string $baseType
     * @return self
     */
    public function setBaseType($baseType)
    {
        $msg = null;
        if (null != $baseType && !$this->isTQualifiedNameValid($baseType)) {
            $msg = "Base type must be a valid TQualifiedName";
            throw new \InvalidArgumentException($msg);
        }
        $this->baseType = $baseType;
        return $this;
    }

    /**
     * Gets as abstract
     *
     * @return boolean
     */
    public function getAbstract()
    {
        return boolval($this->abstract);
    }

    /**
     * Sets a new abstract
     *
     * @param  boolean $abstract
     * @return self
     */
    public function setAbstract($abstract)
    {
        $this->abstract = boolval($abstract);
        return $this;
    }

    public function isTDerivableTypeAttributesValid(&$msg)
    {
        if (!$this->isTTypeAttributesValid($msg)) {
            return false;
        }
        if (null != $this->baseType && !$this->isTQualifiedNameValid($this->baseType)) {
            $msg = "Base type must be a valid TQualifiedName: " . get_class($this);
            return false;
        }
        return true;
    }
}
