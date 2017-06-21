<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\Groups\TModificationFunctionMappingComplexPropertyPropertyGroup;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TModificationFunctionMappingComplexPropertyType
 *
 * Type for function mapping complex property
 *
 * XSD Type: TModificationFunctionMappingComplexProperty
 */
class TModificationFunctionMappingComplexPropertyType extends IsOK
{
    use TSimpleIdentifierTrait, TModificationFunctionMappingComplexPropertyPropertyGroup;
    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $typeName
     */
    private $typeName = null;

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
        if (!$this->isStringNotNullOrEmpty($name)) {
            $msg = 'Name cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTSimpleIdentifierValid($name)) {
            $msg = 'Name must be a valid TSimpleIdentifier';
            throw new \InvalidArgumentException($msg);
        }
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as typeName
     *
     * @return string
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * Sets a new typeName
     *
     * @param  string $typeName
     * @return self
     */
    public function setTypeName($typeName)
    {
        if (!$this->isStringNotNullOrEmpty($typeName)) {
            $msg = 'Type name cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        $this->typeName = $typeName;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->name)) {
            $msg = 'Name cannot be null or empty';
            return false;
        }
        if (!$this->isStringNotNullOrEmpty($this->typeName)) {
            $msg = 'Type name cannot be null or empty';
            return false;
        }
        if (!$this->isTSimpleIdentifierValid($this->name)) {
            $msg = 'Name must be a valid TSimpleIdentifier';
            return false;
        }
        if (!$this->isComplexPropertyPropertyGroupOK($msg)) {
            return false;
        }
        return true;
    }
}
