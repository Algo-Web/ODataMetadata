<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TFunctionImportMappingResultMappingType
 *
 * Type for FunctionImportMapping/ResultMapping element
 *
 * XSD Type: TFunctionImportMappingResultMapping
 */
class TFunctionImportMappingResultMappingType extends IsOK
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportEntityTypeMappingType[]
     * $entityTypeMapping
     */
    private $entityTypeMapping = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportComplexTypeMappingType
     * $complexTypeMapping
     */
    private $complexTypeMapping = null;

    /**
     * Adds as entityTypeMapping
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportEntityTypeMappingType
     * $entityTypeMapping
     */
    public function addToEntityTypeMapping(TFunctionImportEntityTypeMappingType $entityTypeMapping)
    {
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportEntityTypeMappingType[]
     */
    public function getEntityTypeMapping()
    {
        return $this->entityTypeMapping;
    }

    /**
     * Sets a new entityTypeMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportEntityTypeMappingType[]
     * $entityTypeMapping
     * @return self
     */
    public function setEntityTypeMapping(array $entityTypeMapping)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $entityTypeMapping,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportEntityTypeMappingType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->entityTypeMapping = $entityTypeMapping;
        return $this;
    }

    /**
     * Gets as complexTypeMapping
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportComplexTypeMappingType
     */
    public function getComplexTypeMapping()
    {
        return $this->complexTypeMapping;
    }

    /**
     * Sets a new complexTypeMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportComplexTypeMappingType
     * $complexTypeMapping
     * @return self
     */
    public function setComplexTypeMapping(TFunctionImportComplexTypeMappingType $complexTypeMapping)
    {
        $msg = null;
        if (!$complexTypeMapping->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->complexTypeMapping = $complexTypeMapping;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (null == $this->complexTypeMapping) {
            $msg = "Complex type mapping cannot be null";
            return false;
        }
        if (!$this->complexTypeMapping->isOK($msg)) {
            return false;
        }
        if (!$this->isValidArray(
            $this->entityTypeMapping,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportEntityTypeMappingType'
        )
        ) {
            $msg = "Entity type mapping not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->entityTypeMapping, $msg)) {
            return false;
        }
        return true;
    }
}
