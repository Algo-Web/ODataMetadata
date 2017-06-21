<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TQualifiedNameTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TSchemaType
 *
 * XSD Type: TSchema
 */
class TSchemaType extends IsOK
{
    use TQualifiedNameTrait, TSimpleIdentifierTrait, GSchemaBodyElementsTrait;
    /**
     * @property string $namespace
     */
    private $namespace = null;

    /**
     * @property string $alias
     */
    private $alias = null;

    /**
     * @property string $provider
     */
    private $provider = null;

    /**
     * @property string $providerManifestToken
     */
    private $providerManifestToken = null;

    /**
     * Gets as namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Sets a new namespace
     *
     * @param  string $namespace
     * @return self
     */
    public function setNamespace($namespace)
    {
        $msg = null;
        if (!$this->isStringNotNullOrEmpty($namespace)) {
            $msg = "Namespace cannot be null or empty";
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTQualifiedNameValid($namespace)) {
            $msg = "Namespace must be valid TQualifiedName";
            throw new \InvalidArgumentException($msg);
        }
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * Gets as alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Sets a new alias
     *
     * @param  string $alias
     * @return self
     */
    public function setAlias($alias)
    {
        $msg = null;
        if (!$this->isStringNotNullOrEmpty($alias)) {
            $msg = "Alias cannot be empty";
            throw new \InvalidArgumentException($msg);
        }
        if (null != $alias && !$this->isTSimpleIdentifierValid($alias)) {
            $msg = "Alias must be valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->alias = $alias;
        return $this;
    }

    /**
     * Gets as provider
     *
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Sets a new provider
     *
     * @param  string $provider
     * @return self
     */
    public function setProvider($provider)
    {
        $msg = null;
        if (!$this->isStringNotNullOrEmpty($provider)) {
            $msg = "Provider cannot be null or empty";
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTSimpleIdentifierValid($provider)) {
            $msg = "Provider must be valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->provider = $provider;
        return $this;
    }

    /**
     * Gets as providerManifestToken
     *
     * @return string
     */
    public function getProviderManifestToken()
    {
        return $this->providerManifestToken;
    }

    /**
     * Sets a new providerManifestToken
     *
     * @param  string $providerManifestToken
     * @return self
     */
    public function setProviderManifestToken($providerManifestToken)
    {
        $msg = null;
        if (!$this->isStringNotNullOrEmpty($providerManifestToken)) {
            $msg = "Provider manifest token cannot be null or empty";
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTSimpleIdentifierValid($providerManifestToken)) {
            $msg = "Provider manifest token must be valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->providerManifestToken = $providerManifestToken;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->namespace)) {
            $msg = "Namespace cannot be null or empty";
            return false;
        }
        if (!$this->isStringNotNullOrEmpty($this->provider)) {
            $msg = "Provider cannot be null or empty";
            return false;
        }
        if (!$this->isStringNotNullOrEmpty($this->providerManifestToken)) {
            $msg = "Provider manifest token cannot be null or empty";
            return false;
        }
        if (!$this->isStringNotNullOrEmpty($this->alias)) {
            $msg = "Alias cannot be empty";
            return false;
        }
        if (!$this->isTQualifiedNameValid($this->namespace)) {
            $msg = "Namespace must be valid TQualifiedName";
            return false;
        }
        if (null != $this->alias && !$this->isTSimpleIdentifierValid($this->alias)) {
            $msg = "Alias must be valid TSimpleIdentifier";
            return false;
        }
        if (!$this->isTSimpleIdentifierValid($this->providerManifestToken)) {
            $msg = "Provider manifest token must be valid TSimpleIdentifier";
            return false;
        }
        if (!$this->isTSimpleIdentifierValid($this->provider)) {
            $msg = "Provider must be valid TSimpleIdentifier";
            return false;
        }
        if (!$this->isBodyElementsOK($msg)) {
            return false;
        }

        return true;
    }
}
