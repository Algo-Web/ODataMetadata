<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

/**
 * Class representing TFunctionImportMappingResultMappingType
 *
 *
 * XSD Type: TFunctionImportMappingResultMapping
 */
class TFunctionImportMappingResultMappingType
{

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportEntityTypeMappingType[]
     * $entityTypeMapping
     */
    private $entityTypeMapping = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportComplexTypeMappingType
     * $complexTypeMapping
     */
    private $complexTypeMapping = null;

    /**
     * Adds as entityTypeMapping
     *
     * @return self
     * @param \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportEntityTypeMappingType
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
     * @param scalar $index
     * @return boolean
     */
    public function issetEntityTypeMapping($index)
    {
        return isset($this->entityTypeMapping[$index]);
    }

    /**
     * unset entityTypeMapping
     *
     * @param scalar $index
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
     * @param \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportEntityTypeMappingType[]
     * $entityTypeMapping
     * @return self
     */
    public function setEntityTypeMapping(array $entityTypeMapping)
    {
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
     * @param \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportComplexTypeMappingType
     * $complexTypeMapping
     * @return self
     */
    public function setComplexTypeMapping(TFunctionImportComplexTypeMappingType $complexTypeMapping)
    {
        $this->complexTypeMapping = $complexTypeMapping;
        return $this;
    }
}
