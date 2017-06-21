<?php

namespace AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TReferentialConstraintRoleElementType
 *
 * XSD Type: TReferentialConstraintRoleElement
 */
class TReferentialConstraintRoleElementType extends IsOK
{

    /**
     * @property string $role
     */
    private $role = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TPropertyRefType[] $propertyRef
     */
    private $propertyRef = array();

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
        $this->role = $role;
        return $this;
    }

    /**
     * Gets as documentation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as propertyRef
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TPropertyRefType $propertyRef
     */
    public function addToPropertyRef(TPropertyRefType $propertyRef)
    {
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
     * @return \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TPropertyRefType[]
     */
    public function getPropertyRef()
    {
        return $this->propertyRef;
    }

    /**
     * Sets a new propertyRef
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\edm\ssdl\TPropertyRefType[] $propertyRef
     * @return self
     */
    public function setPropertyRef(array $propertyRef)
    {
        $this->propertyRef = $propertyRef;
        return $this;
    }
}
