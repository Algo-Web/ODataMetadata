<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TAliasType
 * Type for Alias element
 *
 * The Alias element in mapping specification language (MSL) is a child of the Mapping element that is used to define aliases for conceptual model and storage model namespaces. Names of all conceptual or storage model types that are referenced in MSL must be qualified by their respective namespace names. For information about the conceptual model namespace name, see Schema Element (CSDL). For information about the storage model namespace name, see Schema Element (SSDL).
 * The Alias element cannot have child elements.
 *
 * XSD Type: TAlias
 */
class TAliasType extends IsOK
{
    use TSimpleIdentifierTrait;
    /**
     * @property string $key Required, The alias for the namespace that is specified by the Value attribute.
     */
    private $key = null;

    /**
     * @property string $value Required, The namespace for which the value of the Key element is an alias.
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
        if (!$this->isStringNotNullOrEmpty($key)) {
            $msg = 'Key cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTSimpleIdentifierValid($key)) {
            $msg = 'Name must be a valid TSimpleIdentifier';
            throw new \InvalidArgumentException($msg);
        }
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
        if (!$this->isStringNotNullOrEmpty($value)) {
            $msg = 'Value cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
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
