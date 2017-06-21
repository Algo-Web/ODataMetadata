<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\Groups\TPropertyGroup;
use AlgoWeb\ODataMetadata\MetadataV4\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TEntitySetMappingType
 *
 * Type for EntitySet mapping element
 *
 * XSD Type: TEntitySetMapping
 */
class TEntitySetMappingType extends IsOK
{
    use TSimpleIdentifierTrait, TPropertyGroup;
    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $typeName
     */
    private $typeName = null;

    /**
     * @property string $storeEntitySet
     */
    private $storeEntitySet = null;

    /**
     * @property boolean $makeColumnsDistinct
     */
    private $makeColumnsDistinct = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TQueryViewType[] $queryView
     */
    private $queryView = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeMappingType[] $entityTypeMapping
     */
    private $entityTypeMapping = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TMappingFragmentType[] $mappingFragment
     */
    private $mappingFragment = [];

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
        if (!$this->isStringNotNullOrEmpty($name)) {
            $msg = 'Name cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        $this->name = $name;
        return $this;
    }

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
        if (null != $typeName && !$this->isStringNotNullOrEmpty($typeName)) {
            $msg = 'Type name cannot be empty';
            throw new \InvalidArgumentException($msg);
        }
        $this->typeName = $typeName;
        return $this;
    }

    /**
     * Gets as storeEntitySet
     *
     * @return string
     */
    public function getStoreEntitySet()
    {
        return $this->storeEntitySet;
    }

    /**
     * Sets a new storeEntitySet
     *
     * @param  string $storeEntitySet
     * @return self
     */
    public function setStoreEntitySet($storeEntitySet)
    {
        if (null != $storeEntitySet && !$this->isStringNotNullOrEmpty($storeEntitySet)) {
            $msg = 'Store entity set cannot be empty';
            throw new \InvalidArgumentException($msg);
        }
        $this->storeEntitySet = $storeEntitySet;
        return $this;
    }

    /**
     * Gets as makeColumnsDistinct
     *
     * @return boolean
     */
    public function getMakeColumnsDistinct()
    {
        return $this->makeColumnsDistinct;
    }

    /**
     * Sets a new makeColumnsDistinct
     *
     * @param  boolean $makeColumnsDistinct
     * @return self
     */
    public function setMakeColumnsDistinct($makeColumnsDistinct)
    {
        $this->makeColumnsDistinct = $makeColumnsDistinct;
        return $this;
    }

    /**
     * Adds as queryView
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TQueryViewType $queryView
     */
    public function addToQueryView(TQueryViewType $queryView)
    {
        $msg = null;
        if (!$queryView->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->queryView[] = $queryView;
        return $this;
    }

    /**
     * isset queryView
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetQueryView($index)
    {
        return isset($this->queryView[$index]);
    }

    /**
     * unset queryView
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetQueryView($index)
    {
        unset($this->queryView[$index]);
    }

    /**
     * Gets as queryView
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TQueryViewType[]
     */
    public function getQueryView()
    {
        return $this->queryView;
    }

    /**
     * Sets a new queryView
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TQueryViewType[] $queryView
     * @return self
     */
    public function setQueryView(array $queryView)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $queryView,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TQueryViewType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->queryView = $queryView;
        return $this;
    }

    /**
     * Adds as entityTypeMapping
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeMappingType $entityTypeMapping
     */
    public function addToEntityTypeMapping(TEntityTypeMappingType $entityTypeMapping)
    {
        $msg = null;
        if (!$entityTypeMapping->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->entityTypeMapping[] = $entityTypeMapping;
        return $this;
    }

    /**
     * isset entityTypeMapping
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetEntityTypeMapping($index)
    {
        return isset($this->entityTypeMapping[$index]);
    }

    /**
     * unset entityTypeMapping
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEntityTypeMapping($index)
    {
        unset($this->entityTypeMapping[$index]);
    }

    /**
     * Gets as entityTypeMapping
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeMappingType[]
     */
    public function getEntityTypeMapping()
    {
        return $this->entityTypeMapping;
    }

    /**
     * Sets a new entityTypeMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeMappingType[] $entityTypeMapping
     * @return self
     */
    public function setEntityTypeMapping(array $entityTypeMapping)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $entityTypeMapping,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeMappingType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->entityTypeMapping = $entityTypeMapping;
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

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->name)) {
            $msg = 'Name cannot be null or empty';
            return false;
        }
        if (null != $this->typeName && !$this->isStringNotNullOrEmpty($this->typeName)) {
            $msg = 'Type name cannot be empty';
            return false;
        }
        if (null != $this->storeEntitySet && !$this->isStringNotNullOrEmpty($this->storeEntitySet)) {
            $msg = 'Store entity set cannot be empty';
            return false;
        }
        if (!$this->isPropertyGroupOK($msg)) {
            return false;
        }
        if (!$this->isValidArray(
            $this->entityTypeMapping,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeMappingType'
        )
        ) {
            $msg = "Mapping fragment array not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->entityTypeMapping, $msg)) {
            return false;
        }
        if (!$this->isValidArray(
            $this->queryView,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeMappingType'
        )
        ) {
            $msg = "Query view array not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->queryView, $msg)) {
            return false;
        }
        if (!$this->isValidArray(
            $this->mappingFragment,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntityTypeMappingType'
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
