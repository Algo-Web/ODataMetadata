<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

/**
 * Class representing TPropertyRefType
 *
 *
 * XSD Type: TPropertyRef
 */
class TPropertyRefType
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property \MetadataV3\edm\ssdl\TDocumentationType $documentation
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
     * Gets as documentation
     *
     * @return \MetadataV3\edm\ssdl\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param \MetadataV3\edm\ssdl\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(\MetadataV3\edm\ssdl\TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }
}
