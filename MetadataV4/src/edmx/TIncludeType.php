<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edmx;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TIncludeType
 *
 *
 * XSD Type: TInclude
 */
class TIncludeType extends IsOK
{

    /**
     * @property string $namespace
     */
    private $namespace = null;

    /**
     * @property string $alias
     */
    private $alias = null;

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
     * @param string $namespace
     * @return self
     */
    public function setNamespace($namespace)
    {
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
     * @param string $alias
     * @return self
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }

    protected function IsOK(&$msg)
    {
        if (!$this->isStringNotNullOrEmpty($this->namespace)) {
            $msg = "Namespace Must be defined";
            return false;
        }
        if (!$this->IsTNamespaceNameValid($this->namespace)) {
            $msg = "Namespace Must be a valid NameSpace";
            return false;
        }


        if (null != $this->alias) {
            if (!is_string($this->alias)) {
                $msg = "alias  must be either a string or null";
                return false;
            }
            if (!$this->IsTSimpleIdentifierValid($this->alias)) {
                $msg = "alias  Must be a valid TSimpleIdentifyer";
                return false;
            }
        }
        return true;
    }
}
