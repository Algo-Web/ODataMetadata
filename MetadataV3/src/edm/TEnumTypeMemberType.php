<?php

namespace MetadataV3\edm;

/**
 * Class representing TEnumTypeMemberType
 *
 *
 * XSD Type: TEnumTypeMember
 */
class TEnumTypeMemberType
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property integer $value
     */
    private $value = null;

    /**
     * @property \MetadataV3\edm\TDocumentationType $documentation
     */
    private $documentation = null;

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
     * Gets as value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets a new value
     *
     * @param integer $value
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Gets as documentation
     *
     * @return \MetadataV3\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param \MetadataV3\edm\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(\MetadataV3\edm\TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }
}
