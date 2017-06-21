<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TPropertyRefType
 *
 * XSD Type: TPropertyRef
 */
class TPropertyRefType extends IsOK
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $alias
     */
    private $alias = null;

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
        $this->alias = $alias;
        return $this;
    }
}
