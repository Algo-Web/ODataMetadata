<?php

namespace MetadataV2\mapping\cs;

/**
 * Class representing TFunctionImportMappingResultMappingType
 *
 *
 * XSD Type: TFunctionImportMappingResultMapping
 */
class TFunctionImportMappingResultMappingType
{

    /**
     * @property \MetadataV2\mapping\cs\TFunctionImportEntityTypeMappingType[]
     * $entityTypeMapping
     */
    private $entityTypeMapping = array(
        
    );

    /**
     * @property \MetadataV2\mapping\cs\TFunctionImportComplexTypeMappingType[]
     * $complexTypeMapping
     */
    private $complexTypeMapping = array(
        
    );

    /**
     * Adds as entityTypeMapping
     *
     * @return self
     * @param \MetadataV2\mapping\cs\TFunctionImportEntityTypeMappingType
     * $entityTypeMapping
     */
    public function addToEntityTypeMapping(\MetadataV2\mapping\cs\TFunctionImportEntityTypeMappingType $entityTypeMapping)
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
     * @return \MetadataV2\mapping\cs\TFunctionImportEntityTypeMappingType[]
     */
    public function getEntityTypeMapping()
    {
        return $this->entityTypeMapping;
    }

    /**
     * Sets a new entityTypeMapping
     *
     * @param \MetadataV2\mapping\cs\TFunctionImportEntityTypeMappingType[]
     * $entityTypeMapping
     * @return self
     */
    public function setEntityTypeMapping(array $entityTypeMapping)
    {
        $this->entityTypeMapping = $entityTypeMapping;
        return $this;
    }

    /**
     * Adds as complexTypeMapping
     *
     * @return self
     * @param \MetadataV2\mapping\cs\TFunctionImportComplexTypeMappingType
     * $complexTypeMapping
     */
    public function addToComplexTypeMapping(\MetadataV2\mapping\cs\TFunctionImportComplexTypeMappingType $complexTypeMapping)
    {
        $this->complexTypeMapping[] = $complexTypeMapping;
        return $this;
    }

    /**
     * isset complexTypeMapping
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetComplexTypeMapping($index)
    {
        return isset($this->complexTypeMapping[$index]);
    }

    /**
     * unset complexTypeMapping
     *
     * @param scalar $index
     * @return void
     */
    public function unsetComplexTypeMapping($index)
    {
        unset($this->complexTypeMapping[$index]);
    }

    /**
     * Gets as complexTypeMapping
     *
     * @return \MetadataV2\mapping\cs\TFunctionImportComplexTypeMappingType[]
     */
    public function getComplexTypeMapping()
    {
        return $this->complexTypeMapping;
    }

    /**
     * Sets a new complexTypeMapping
     *
     * @param \MetadataV2\mapping\cs\TFunctionImportComplexTypeMappingType[]
     * $complexTypeMapping
     * @return self
     */
    public function setComplexTypeMapping(array $complexTypeMapping)
    {
        $this->complexTypeMapping = $complexTypeMapping;
        return $this;
    }


}

