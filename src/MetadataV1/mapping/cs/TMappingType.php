<?php

namespace AlgoWeb\ODataMetadata\MetadataV1\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TMappingType
 *
 * XSD Type: TMapping
 */
class TMappingType extends IsOK
{

    /**
     * @property string $space
     */
    private $space = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TAliasType[] $alias
     */
    private $alias = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TEntityContainerMappingType
     * $entityContainerMapping
     */
    private $entityContainerMapping = null;

    /**
     * Gets as space
     *
     * @return string
     */
    public function getSpace()
    {
        return $this->space;
    }

    /**
     * Sets a new space
     *
     * @param  string $space
     * @return self
     */
    public function setSpace($space)
    {
        $this->space = $space;
        return $this;
    }

    /**
     * Adds as alias
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TAliasType $alias
     */
    public function addToAlias(TAliasType $alias)
    {
        $this->alias[] = $alias;
        return $this;
    }

    /**
     * isset alias
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetAlias($index)
    {
        return isset($this->alias[$index]);
    }

    /**
     * unset alias
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetAlias($index)
    {
        unset($this->alias[$index]);
    }

    /**
     * Gets as alias
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TAliasType[]
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Sets a new alias
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TAliasType[] $alias
     * @return self
     */
    public function setAlias(array $alias)
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * Gets as entityContainerMapping
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TEntityContainerMappingType
     */
    public function getEntityContainerMapping()
    {
        return $this->entityContainerMapping;
    }

    /**
     * Sets a new entityContainerMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV1\mapping\cs\TEntityContainerMappingType
     * $entityContainerMapping
     * @return self
     */
    public function setEntityContainerMapping(TEntityContainerMappingType $entityContainerMapping)
    {
        $this->entityContainerMapping = $entityContainerMapping;
        return $this;
    }
}
