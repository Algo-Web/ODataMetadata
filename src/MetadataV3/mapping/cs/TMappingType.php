<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits\TSpaceTrait;

/**
 * Type of root level mapping elements
 *
 * XSD Type: TMapping
 */
class TMappingType extends IsOK
{
    use TSpaceTrait;
    /**
     * @property string $space
     * Space represents the space that the mapping occurs. For CS mapping it always has to be "C-S"
     */
    private $space = null;
    // Top level mapping element can have Alias elements followed by one EntityContainerMapping element.
    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TAliasType[] $alias
     */
    private $alias = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityContainerMappingType
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
        if (!$this->isTSpaceValid($space)) {
            $msg = "Space not a valid TSpace";
            throw new \InvalidArgumentException($msg);
        }
        $this->space = $space;
        return $this;
    }

    /**
     * Adds as alias
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TAliasType $alias
     */
    public function addToAlias(TAliasType $alias)
    {
        $msg = null;
        if (!$alias->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TAliasType[]
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Sets a new alias
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TAliasType[] $alias
     * @return self
     */
    public function setAlias(array $alias)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $alias,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TAliasType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->alias = $alias;
        return $this;
    }

    /**
     * Gets as entityContainerMapping
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityContainerMappingType
     */
    public function getEntityContainerMapping()
    {
        return $this->entityContainerMapping;
    }

    /**
     * Sets a new entityContainerMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityContainerMappingType
     * $entityContainerMapping
     * @return self
     */
    public function setEntityContainerMapping(TEntityContainerMappingType $entityContainerMapping)
    {
        $msg = null;
        if (!$entityContainerMapping->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->entityContainerMapping = $entityContainerMapping;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isTSpaceValid($this->space)) {
            $msg = "Space not a valid TSpace";
            return false;
        }
        if (!$this->isValidArray($this->alias, '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TAliasType')) {
            $msg = "Alias not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->alias, $msg)) {
            return false;
        }
        if (!$this->entityContainerMapping->isOK($msg)) {
            return false;
        }
        return true;
    }
}
