<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TEntityTypeMappingType
 *
 * XSD Type: TEntityTypeMapping
 */
class TEntityTypeMappingType extends IsOK
{

    /**
     * @property string $typeName
     */
    private $typeName = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TMappingFragmentType[] $mappingFragment
     */
    private $mappingFragment = array();

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TEntityTypeModificationFunctionMappingType
     * $modificationFunctionMapping
     */
    private $modificationFunctionMapping = null;

    /**
     * Gets as typeName
     *
     * @return string
     */
    public function getTypeName()
    {
        return $this->typeName;
    }

    /**
     * Sets a new typeName
     *
     * @param  string $typeName
     * @return self
     */
    public function setTypeName($typeName)
    {
        $this->typeName = $typeName;
        return $this;
    }

    /**
     * Adds as mappingFragment
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TMappingFragmentType $mappingFragment
     */
    public function addToMappingFragment(TMappingFragmentType $mappingFragment)
    {
        $this->mappingFragment[] = $mappingFragment;
        return $this;
    }

    /**
     * isset mappingFragment
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetMappingFragment($index)
    {
        return isset($this->mappingFragment[$index]);
    }

    /**
     * unset mappingFragment
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetMappingFragment($index)
    {
        unset($this->mappingFragment[$index]);
    }

    /**
     * Gets as mappingFragment
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TMappingFragmentType[]
     */
    public function getMappingFragment()
    {
        return $this->mappingFragment;
    }

    /**
     * Sets a new mappingFragment
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TMappingFragmentType[] $mappingFragment
     * @return self
     */
    public function setMappingFragment(array $mappingFragment)
    {
        $this->mappingFragment = $mappingFragment;
        return $this;
    }

    /**
     * Gets as modificationFunctionMapping
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TEntityTypeModificationFunctionMappingType
     */
    public function getModificationFunctionMapping()
    {
        return $this->modificationFunctionMapping;
    }

    /**
     * Sets a new modificationFunctionMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\mapping\cs\TEntityTypeModificationFunctionMappingType
     * $modificationFunctionMapping
     * @return self
     */
    public function setModificationFunctionMapping(TEntityTypeModificationFunctionMappingType $modificationFunctionMapping)
    {
        $this->modificationFunctionMapping = $modificationFunctionMapping;
        return $this;
    }
}
