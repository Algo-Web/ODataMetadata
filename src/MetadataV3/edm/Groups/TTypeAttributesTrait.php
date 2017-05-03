<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Groups;

use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;

trait TTypeAttributesTrait
{
    use TSimpleIdentifierTrait;
    /**
     * @property string $name
     */
    private $name = null;

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

    public function isTTypeAttributesValid(&$msg = null)
    {
        if (null == $this->name) {
            $msg = "Name cannot be null";
            return false;
        }
        if (!$this->isTSimpleIdentifierValid($this->name)) {
            $msg = "Name must be a valid TSimpleIdentifier";
            return false;
        }
        
        return true;
    }
}
