<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TEnumTypeType
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
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\TEnumTypeMemberType[] $member
     */
    private $member = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $annotation
     */
    private $annotation = array();

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
        $this->underlyingType = $underlyingType;
        return $this;
    }

    /**
     * Adds as member
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TEnumTypeMemberType $member
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
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\TEnumTypeMemberType[]
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Sets a new member
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\TEnumTypeMemberType[] $member
     * @return self
     */
    public function setMember(array $member)
    {
        $this->member = $member;
        return $this;
    }

    /**
     * Adds as annotation
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation $annotation
     */
    public function addToAnnotation(Annotation $annotation)
    {
        $this->annotation[] = $annotation;
        return $this;
    }

    /**
     * isset annotation
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetAnnotation($index)
    {
        return isset($this->annotation[$index]);
    }

    /**
     * unset annotation
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetAnnotation($index)
    {
        unset($this->annotation[$index]);
    }

    /**
     * Gets as annotation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[]
     */
    public function getAnnotation()
    {
        return $this->annotation;
    }

    /**
     * Sets a new annotation
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV4\edm\Annotation[] $annotation
     * @return self
     */
    public function setAnnotation(array $annotation)
    {
        $this->annotation = $annotation;
        return $this;
    }
}
