<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TAliasType
 *
 *
 * XSD Type: TAlias
 */
class TAliasType extends IsOK
{
    use TSimpleIdentifierTrait;
    /**
     * @property string $key
     */
    private $key = null;

    /**
     * @property string $value
     */
    private $value = null;

    /**
     * Gets as key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Sets a new key
     *
     * @param string $key
     * @return self
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Gets as value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets a new value
     *
     * @param string $value
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->key)) {
            $msg = 'Key cannot be null or empty';
            return false;
        }
        if (!$this->isStringNotNullOrEmpty($this->value)) {
            $msg = 'Value cannot be null or empty';
            return false;
        }
        if (!$this->isTSimpleIdentifierValid($this->key)) {
            $msg = 'Name must be a valid TSimpleIdentifier';
            return false;
        }
        return true;
    }
}
