<?php

namespace MetadataV3\mapping\cs;

/**
 * Class representing TFunctionImportMappingResultMappingType
 *
 *
 * XSD Type: TFunctionImportMappingResultMapping
 */
class TFunctionImportMappingResultMappingType
{

    /**
     * @property \MetadataV3\mapping\cs\TFunctionImportEntityTypeMappingType[]
     * $entityTypeMapping
     */
    private $entityTypeMapping = array(
        
    );

    /**
     * @property \MetadataV3\mapping\cs\TFunctionImportComplexTypeMappingType
     * $complexTypeMapping
     */
    private $complexTypeMapping = null;

    /**
     * Adds as entityTypeMapping
     *
     * @return self
     * @param \MetadataV3\mapping\cs\TFunctionImportEntityTypeMappingType
     * $entityTypeMapping
     */
    public function addToEntityTypeMapping(\MetadataV3\mapping\cs\TFunctionImportEntityTypeMappingType $entityTypeMapping)
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
     * @return \MetadataV3\mapping\cs\TFunctionImportEntityTypeMappingType[]
     */
    public function getEntityTypeMapping()
    {
        return $this->entityTypeMapping;
    }

    /**
     * Sets a new entityTypeMapping
     *
     * @param \MetadataV3\mapping\cs\TFunctionImportEntityTypeMappingType[]
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
     * @return \MetadataV3\mapping\cs\TFunctionImportComplexTypeMappingType
     */
    public function getComplexTypeMapping()
    {
        return $this->complexTypeMapping;
    }

    /**
     * Sets a new complexTypeMapping
     *
     * @param \MetadataV3\mapping\cs\TFunctionImportComplexTypeMappingType
     * $complexTypeMapping
     * @return self
     */
    public function setComplexTypeMapping(\MetadataV3\mapping\cs\TFunctionImportComplexTypeMappingType $complexTypeMapping)
    {
        $this->complexTypeMapping = $complexTypeMapping;
        return $this;
    }


}

