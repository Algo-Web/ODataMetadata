<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\CodeGeneration\AccessTypeTraits;
use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\TTypeAttributesTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TPropertyTypeTrait;

/**
 * Class representing TEnumTypeType
 *
 * XSD Type: TEnumType
 */
class TEnumTypeType extends IsOK
{
    use IsOKToolboxTrait, TTypeAttributesTrait, TPropertyTypeTrait, AccessTypeTraits {
        TTypeAttributesTrait::isNCName insteadof TPropertyTypeTrait;
        TTypeAttributesTrait::matchesRegexPattern insteadof TPropertyTypeTrait;
        TTypeAttributesTrait::isName insteadof TPropertyTypeTrait;
    }

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
    private $member = [];

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
     * @param  boolean $isFlags
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
     * @param  string $underlyingType
     * @return self
     */
    public function setUnderlyingType($underlyingType)
    {
        if (!$this->isTPropertyTypeValid($underlyingType)) {
            $msg = "Underlying type must be a valid TPropertyType";
            throw new \InvalidArgumentException($msg);
        }
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
     * @param  string $typeAccess
     * @return self
     */
    public function setTypeAccess($typeAccess)
    {
        if (!$this->isTPublicOrInternalAccessOK($typeAccess)) {
            $msg = "Type access must be Public or Internal";
            throw new \InvalidArgumentException($msg);
        }
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
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
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
     * Adds as member
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeMemberType $member
     */
    public function addToMember(TEnumTypeMemberType $member)
    {
        $this->member[] = $member;
        return $this;
    }

    /**
     * isset member
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetMember($index)
    {
        return isset($this->member[$index]);
    }

    /**
     * unset member
     *
     * @param  scalar $index
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
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeMemberType[] $member
     * @return self
     */
    public function setMember(array $member)
    {
        if (!$this->isValidArrayOK(
            $member,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeMemberType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->member = $member;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isTPropertyTypeValid($this->underlyingType)) {
            $msg = "Underlying type must be a valid TPropertyType";
            return false;
        }
        if (!$this->isTPublicOrInternalAccessOK($this->typeAccess)) {
            $msg = "Type access must be Public or Internal";
            return false;
        }
        if (!$this->isObjectNullOrOK($this->documentation, $msg)) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->member,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TEnumTypeMemberType',
            $msg
        )
        ) {
            return false;
        }

        if (!$this->isTTypeAttributesValid($msg)) {
            return false;
        }
        return true;
    }
}
