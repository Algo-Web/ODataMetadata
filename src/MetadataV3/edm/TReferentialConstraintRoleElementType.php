<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TReferentialConstraintRoleElementType
 *
 * XSD Type: TReferentialConstraintRoleElement
 */
class TReferentialConstraintRoleElementType extends IsOK
{
    use IsOKToolboxTrait, TSimpleIdentifierTrait;
    /**
     * @property string $role
     */
    private $role = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType[] $propertyRef
     */
    private $propertyRef = [];

    /**
     * Gets as role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Sets a new role
     *
     * @param  string $role
     * @return self
     */
    public function setRole($role)
    {
        if (!$this->isTSimpleIdentifierValid($role)) {
            $msg = "Role must be a valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->role = $role;
        return $this;
    }

    /**
     * Adds as propertyRef
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType $propertyRef
     */
    public function addToPropertyRef(TPropertyRefType $propertyRef)
    {
        $msg = null;
        if (!$propertyRef->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->propertyRef[] = $propertyRef;
        return $this;
    }

    /**
     * isset propertyRef
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetPropertyRef($index)
    {
        return isset($this->propertyRef[$index]);
    }

    /**
     * unset propertyRef
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetPropertyRef($index)
    {
        unset($this->propertyRef[$index]);
    }

    /**
     * Gets as propertyRef
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType[]
     */
    public function getPropertyRef()
    {
        return $this->propertyRef;
    }

    /**
     * Sets a new propertyRef
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType[] $propertyRef
     * @return self
     */
    public function setPropertyRef(array $propertyRef)
    {
        if (!$this->isValidArrayOK(
            $this->propertyRef,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType',
            $msg,
            1
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->propertyRef = $propertyRef;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isTSimpleIdentifierValid($this->role)) {
            $msg = "Role must be a valid TSimpleIdentifier";
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->propertyRef,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType',
            $msg,
            1
        )
        ) {
            return false;
        }

        return true;
    }
}
