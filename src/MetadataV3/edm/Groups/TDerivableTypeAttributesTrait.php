<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Groups;

use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TQualifiedNameTrait;

trait TDerivableTypeAttributesTrait
{
    use TQualifiedNameTrait, TTypeAttributesTrait;
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
     * @param string $baseType
     * @return self
     */
    public function setBaseType($baseType)
    {
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
     * @param boolean $abstract
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
            $msg = "Base type must be a valid TQualifiedName";
            return false;
        }
        return true;
    }
}
