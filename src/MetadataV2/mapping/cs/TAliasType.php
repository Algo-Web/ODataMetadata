<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\mapping\cs;

/**
 * Class representing TAliasType
 *
 * XSD Type: TAlias
 */
class TAliasType
{

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
     * @param  string $key
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
     * @param  string $value
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
