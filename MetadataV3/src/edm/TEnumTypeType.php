<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TEnumTypeType
 *
 *
 * XSD Type: TEnumType
 */
class TEnumTypeType extends IsOK
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property boolean $isFlags
     */
    private $isFlags = null;

    /**
     * @property string $underlyingType
     */
    private $underlyingType = null;

    /**
     * @property string $typeAccess
     */
    private $typeAccess = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeMemberType[] $member
     */
    private $member = array();

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

    /**
     * Gets as isFlags
     *
     * @return boolean
     */
    public function getIsFlags()
    {
        return $this->isFlags;
    }

    /**
     * Sets a new isFlags
     *
     * @param boolean $isFlags
     * @return self
     */
    public function setIsFlags($isFlags)
    {
        $this->isFlags = $isFlags;
        return $this;
    }

    /**
     * Gets as underlyingType
     *
     * @return string
     */
    public function getUnderlyingType()
    {
        return $this->underlyingType;
    }

    /**
     * Sets a new underlyingType
     *
     * @param string $underlyingType
     * @return self
     */
    public function setUnderlyingType($underlyingType)
    {
        $this->underlyingType = $underlyingType;
        return $this;
    }

    /**
     * Gets as typeAccess
     *
     * @return string
     */
    public function getTypeAccess()
    {
        return $this->typeAccess;
    }

    /**
     * Sets a new typeAccess
     *
     * @param string $typeAccess
     * @return self
     */
    public function setTypeAccess($typeAccess)
    {
        $this->typeAccess = $typeAccess;
        return $this;
    }

    /**
     * Gets as documentation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as member
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeMemberType $member
     */
    public function addToMember(TEnumTypeMemberType $member)
    {
        $this->member[] = $member;
        return $this;
    }

    /**
     * isset member
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetMember($index)
    {
        return isset($this->member[$index]);
    }

    /**
     * unset member
     *
     * @param scalar $index
     * @return void
     */
    public function unsetMember($index)
    {
        unset($this->member[$index]);
    }

    /**
     * Gets as member
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeMemberType[]
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Sets a new member
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeMemberType[] $member
     * @return self
     */
    public function setMember(array $member)
    {
        $this->member = $member;
        return $this;
    }
}
