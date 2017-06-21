<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TNavigationPropertyBindingType
 *
 * XSD Type: TNavigationPropertyBinding
 */
class TNavigationPropertyBindingType extends IsOK
{

    /**
     * @property string $path
     */
    private $path = null;

    /**
     * @property string $target
     */
    private $target = null;

    /**
     * Gets as path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Sets a new path
     *
     * @param  string $path
     * @return self
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Gets as target
     *
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Sets a new target
     *
     * @param  string $target
     * @return self
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }
}
