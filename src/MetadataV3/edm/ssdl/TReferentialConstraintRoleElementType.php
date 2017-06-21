<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TReferentialConstraintRoleElementType
 *
 * XSD Type: TReferentialConstraintRoleElement
 */
class TReferentialConstraintRoleElementType extends IsOK
{
    use TSimpleIdentifierTrait;
    /**
     * @property string $role
     */
    private $role = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TPropertyRefType[] $propertyRef
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
        if (!$this->isStringNotNullOrEmpty($role)) {
            $msg = "Role cannot be empty or null";
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTSimpleIdentifierValid($role)) {
            $msg = "Role must be valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->role = $role;
        return $this;
    }

    /**
     * Gets as documentation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $msg = null;
        if (!$documentation->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as propertyRef
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TPropertyRefType $propertyRef
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TPropertyRefType[]
     */
    public function getPropertyRef()
    {
        return $this->propertyRef;
    }

    /**
     * Sets a new propertyRef
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TPropertyRefType[] $propertyRef
     * @return self
     */
    public function setPropertyRef(array $propertyRef)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $propertyRef,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TPropertyRefType',
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
        if (!$this->isStringNotNullOrEmpty($this->role)) {
            $msg = "Role cannot be empty or null";
            return false;
        }
        if (!$this->isTSimpleIdentifierValid($this->role)) {
            $msg = "Role must be valid TSimpleIdentifier";
            return false;
        }
        if (!$this->isObjectNullOrOK($this->documentation, $msg)) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->propertyRef,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TPropertyRefType',
            $msg,
            1
        )
        ) {
            return false;
        }
        return true;
    }
}
