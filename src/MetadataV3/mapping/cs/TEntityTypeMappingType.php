<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TEntityTypeMappingType
 *
 * Type for EntityTypeMapping element
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
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TMappingFragmentType[] $mappingFragment
     */
    private $mappingFragment = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeModificationFunctionMappingType
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
        if (!$this->isStringNotNullOrEmpty($typeName)) {
            $msg = 'Type name cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        $this->typeName = $typeName;
        return $this;
    }

    /**
     * Adds as mappingFragment
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TMappingFragmentType $mappingFragment
     */
    public function addToMappingFragment(TMappingFragmentType $mappingFragment)
    {
        $msg = null;
        if (!$mappingFragment->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TMappingFragmentType[]
     */
    public function getMappingFragment()
    {
        return $this->mappingFragment;
    }

    /**
     * Sets a new mappingFragment
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TMappingFragmentType[] $mappingFragment
     * @return self
     */
    public function setMappingFragment(array $mappingFragment)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $mappingFragment,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TMappingFragmentType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->mappingFragment = $mappingFragment;
        return $this;
    }

    /**
     * Gets as modificationFunctionMapping
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeModificationFunctionMappingType
     */
    public function getModificationFunctionMapping()
    {
        return $this->modificationFunctionMapping;
    }

    /**
     * Sets a new modificationFunctionMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeModificationFunctionMappingType
     * $modificationFunctionMapping
     * @return self
     */
    public function setModificationFunctionMapping(TEntityTypeModificationFunctionMappingType $modificationFunctionMapping)
    {
        $msg = null;
        if (!$modificationFunctionMapping->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->modificationFunctionMapping = $modificationFunctionMapping;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->typeName)) {
            $msg = 'Type name cannot be null or empty';
            return false;
        }
        if (null != $this->modificationFunctionMapping && !$this->modificationFunctionMapping > isOK($msg)) {
            return false;
        }
        if (!$this->isValidArray(
            $this->mappingFragment,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TMappingFragmentType'
        )
        ) {
            $msg = "Mapping fragment array not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->mappingFragment, $msg)) {
            return false;
        }
        return true;
    }
}
