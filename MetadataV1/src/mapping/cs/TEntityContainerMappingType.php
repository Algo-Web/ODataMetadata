<?php

namespace MetadataV1\mapping\cs;

/**
 * Class representing TEntityContainerMappingType
 *
 *
 * XSD Type: TEntityContainerMapping
 */
class TEntityContainerMappingType
{

    /**
     * @property string $cdmEntityContainer
     */
    private $cdmEntityContainer = null;

    /**
     * @property string $storageEntityContainer
     */
    private $storageEntityContainer = null;

    /**
     * @property \MetadataV1\mapping\cs\TEntitySetMappingType[] $entitySetMapping
     */
    private $entitySetMapping = array(
        
    );

    /**
     * @property \MetadataV1\mapping\cs\TAssociationSetMappingType[]
     * $associationSetMapping
     */
    private $associationSetMapping = array(
        
    );

    /**
     * @property \MetadataV1\mapping\cs\TFunctionImportMappingType[]
     * $functionImportMapping
     */
    private $functionImportMapping = array(
        
    );

    /**
     * Gets as cdmEntityContainer
     *
     * @return string
     */
    public function getCdmEntityContainer()
    {
        return $this->cdmEntityContainer;
    }

    /**
     * Sets a new cdmEntityContainer
     *
     * @param string $cdmEntityContainer
     * @return self
     */
    public function setCdmEntityContainer($cdmEntityContainer)
    {
        $this->cdmEntityContainer = $cdmEntityContainer;
        return $this;
    }

    /**
     * Gets as storageEntityContainer
     *
     * @return string
     */
    public function getStorageEntityContainer()
    {
        return $this->storageEntityContainer;
    }

    /**
     * Sets a new storageEntityContainer
     *
     * @param string $storageEntityContainer
     * @return self
     */
    public function setStorageEntityContainer($storageEntityContainer)
    {
        $this->storageEntityContainer = $storageEntityContainer;
        return $this;
    }

    /**
     * Adds as entitySetMapping
     *
     * @return self
     * @param \MetadataV1\mapping\cs\TEntitySetMappingType $entitySetMapping
     */
    public function addToEntitySetMapping(\MetadataV1\mapping\cs\TEntitySetMappingType $entitySetMapping)
    {
        $this->entitySetMapping[] = $entitySetMapping;
        return $this;
    }

    /**
     * isset entitySetMapping
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetEntitySetMapping($index)
    {
        return isset($this->entitySetMapping[$index]);
    }

    /**
     * unset entitySetMapping
     *
     * @param scalar $index
     * @return void
     */
    public function unsetEntitySetMapping($index)
    {
        unset($this->entitySetMapping[$index]);
    }

    /**
     * Gets as entitySetMapping
     *
     * @return \MetadataV1\mapping\cs\TEntitySetMappingType[]
     */
    public function getEntitySetMapping()
    {
        return $this->entitySetMapping;
    }

    /**
     * Sets a new entitySetMapping
     *
     * @param \MetadataV1\mapping\cs\TEntitySetMappingType[] $entitySetMapping
     * @return self
     */
    public function setEntitySetMapping(array $entitySetMapping)
    {
        $this->entitySetMapping = $entitySetMapping;
        return $this;
    }

    /**
     * Adds as associationSetMapping
     *
     * @return self
     * @param \MetadataV1\mapping\cs\TAssociationSetMappingType $associationSetMapping
     */
    public function addToAssociationSetMapping(\MetadataV1\mapping\cs\TAssociationSetMappingType $associationSetMapping)
    {
        $this->associationSetMapping[] = $associationSetMapping;
        return $this;
    }

    /**
     * isset associationSetMapping
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetAssociationSetMapping($index)
    {
        return isset($this->associationSetMapping[$index]);
    }

    /**
     * unset associationSetMapping
     *
     * @param scalar $index
     * @return void
     */
    public function unsetAssociationSetMapping($index)
    {
        unset($this->associationSetMapping[$index]);
    }

    /**
     * Gets as associationSetMapping
     *
     * @return \MetadataV1\mapping\cs\TAssociationSetMappingType[]
     */
    public function getAssociationSetMapping()
    {
        return $this->associationSetMapping;
    }

    /**
     * Sets a new associationSetMapping
     *
     * @param \MetadataV1\mapping\cs\TAssociationSetMappingType[]
     * $associationSetMapping
     * @return self
     */
    public function setAssociationSetMapping(array $associationSetMapping)
    {
        $this->associationSetMapping = $associationSetMapping;
        return $this;
    }

    /**
     * Adds as functionImportMapping
     *
     * @return self
     * @param \MetadataV1\mapping\cs\TFunctionImportMappingType $functionImportMapping
     */
    public function addToFunctionImportMapping(\MetadataV1\mapping\cs\TFunctionImportMappingType $functionImportMapping)
    {
        $this->functionImportMapping[] = $functionImportMapping;
        return $this;
    }

    /**
     * isset functionImportMapping
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetFunctionImportMapping($index)
    {
        return isset($this->functionImportMapping[$index]);
    }

    /**
     * unset functionImportMapping
     *
     * @param scalar $index
     * @return void
     */
    public function unsetFunctionImportMapping($index)
    {
        unset($this->functionImportMapping[$index]);
    }

    /**
     * Gets as functionImportMapping
     *
     * @return \MetadataV1\mapping\cs\TFunctionImportMappingType[]
     */
    public function getFunctionImportMapping()
    {
        return $this->functionImportMapping;
    }

    /**
     * Sets a new functionImportMapping
     *
     * @param \MetadataV1\mapping\cs\TFunctionImportMappingType[]
     * $functionImportMapping
     * @return self
     */
    public function setFunctionImportMapping(array $functionImportMapping)
    {
        $this->functionImportMapping = $functionImportMapping;
        return $this;
    }


}

