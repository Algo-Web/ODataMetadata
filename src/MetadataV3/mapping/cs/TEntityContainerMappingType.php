<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV4\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TEntityContainerMappingType
 *
 * Type for EntityContainerMapping element
 *
 * XSD Type: TEntityContainerMapping
 */
class TEntityContainerMappingType extends IsOK
{
    use TSimpleIdentifierTrait;
    /**
     * @property string $cdmEntityContainer
     */
    private $cdmEntityContainer = null;

    /**
     * @property string $storageEntityContainer
     */
    private $storageEntityContainer = null;

    /**
     * @property boolean $generateUpdateViews
     */
    private $generateUpdateViews = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntitySetMappingType[] $entitySetMapping
     */
    private $entitySetMapping = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TAssociationSetMappingType[]
     * $associationSetMapping
     */
    private $associationSetMapping = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportMappingType[]
     * $functionImportMapping
     */
    private $functionImportMapping = [];

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
     * @param  string $cdmEntityContainer
     * @return self
     */
    public function setCdmEntityContainer($cdmEntityContainer)
    {
        if (!$this->isStringNotNullOrEmpty($cdmEntityContainer)) {
            $msg = 'CDM entity container cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTSimpleIdentifierValid($cdmEntityContainer)) {
            $msg = 'CDM entity container must be a valid TSimpleIdentifier';
            throw new \InvalidArgumentException($msg);
        }
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
     * @param  string $storageEntityContainer
     * @return self
     */
    public function setStorageEntityContainer($storageEntityContainer)
    {
        if (!$this->isStringNotNullOrEmpty($storageEntityContainer)) {
            $msg = 'Storage entity container cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        $this->storageEntityContainer = $storageEntityContainer;
        return $this;
    }

    /**
     * Gets as generateUpdateViews
     *
     * @return boolean
     */
    public function getGenerateUpdateViews()
    {
        return $this->generateUpdateViews;
    }

    /**
     * Sets a new generateUpdateViews
     *
     * @param  boolean $generateUpdateViews
     * @return self
     */
    public function setGenerateUpdateViews($generateUpdateViews)
    {
        $this->generateUpdateViews = $generateUpdateViews;
        return $this;
    }

    /**
     * Adds as entitySetMapping
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntitySetMappingType $entitySetMapping
     */
    public function addToEntitySetMapping(TEntitySetMappingType $entitySetMapping)
    {
        $msg = null;
        if (!$entitySetMapping->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->entitySetMapping[] = $entitySetMapping;
        return $this;
    }

    /**
     * isset entitySetMapping
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetEntitySetMapping($index)
    {
        return isset($this->entitySetMapping[$index]);
    }

    /**
     * unset entitySetMapping
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEntitySetMapping($index)
    {
        unset($this->entitySetMapping[$index]);
    }

    /**
     * Gets as entitySetMapping
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntitySetMappingType[]
     */
    public function getEntitySetMapping()
    {
        return $this->entitySetMapping;
    }

    /**
     * Sets a new entitySetMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntitySetMappingType[] $entitySetMapping
     * @return self
     */
    public function setEntitySetMapping(array $entitySetMapping)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $entitySetMapping,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntitySetMappingType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->entitySetMapping = $entitySetMapping;
        return $this;
    }

    /**
     * Adds as associationSetMapping
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TAssociationSetMappingType $associationSetMapping
     */
    public function addToAssociationSetMapping(TAssociationSetMappingType $associationSetMapping)
    {
        $msg = null;
        if (!$associationSetMapping->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->associationSetMapping[] = $associationSetMapping;
        return $this;
    }

    /**
     * isset associationSetMapping
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetAssociationSetMapping($index)
    {
        return isset($this->associationSetMapping[$index]);
    }

    /**
     * unset associationSetMapping
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetAssociationSetMapping($index)
    {
        unset($this->associationSetMapping[$index]);
    }

    /**
     * Gets as associationSetMapping
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TAssociationSetMappingType[]
     */
    public function getAssociationSetMapping()
    {
        return $this->associationSetMapping;
    }

    /**
     * Sets a new associationSetMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TAssociationSetMappingType[]
     * $associationSetMapping
     * @return self
     */
    public function setAssociationSetMapping(array $associationSetMapping)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $associationSetMapping,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TAssociationSetMappingType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->associationSetMapping = $associationSetMapping;
        return $this;
    }

    /**
     * Adds as functionImportMapping
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportMappingType $functionImportMapping
     */
    public function addToFunctionImportMapping(TFunctionImportMappingType $functionImportMapping)
    {
        $msg = null;
        if (!$functionImportMapping->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->functionImportMapping[] = $functionImportMapping;
        return $this;
    }

    /**
     * isset functionImportMapping
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetFunctionImportMapping($index)
    {
        return isset($this->functionImportMapping[$index]);
    }

    /**
     * unset functionImportMapping
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetFunctionImportMapping($index)
    {
        unset($this->functionImportMapping[$index]);
    }

    /**
     * Gets as functionImportMapping
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportMappingType[]
     */
    public function getFunctionImportMapping()
    {
        return $this->functionImportMapping;
    }

    /**
     * Sets a new functionImportMapping
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportMappingType[]
     * $functionImportMapping
     * @return self
     */
    public function setFunctionImportMapping(array $functionImportMapping)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $functionImportMapping,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportMappingType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->functionImportMapping = $functionImportMapping;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->cdmEntityContainer)) {
            $msg = 'CDM entity container cannot be null or empty';
            return false;
        }
        if (!$this->isStringNotNullOrEmpty($this->storageEntityContainer)) {
            $msg = 'Storage entity container cannot be null or empty';
            return false;
        }
        if (!$this->isTSimpleIdentifierValid($this->cdmEntityContainer)) {
            $msg = 'CDM entity container must be a valid TSimpleIdentifier';
            return false;
        }
        if (!$this->isValidArray(
            $this->entitySetMapping,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TEntitySetMappingType'
        )
        ) {
            $msg = "Entity set mapping array not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->entitySetMapping, $msg)) {
            return false;
        }
        if (!$this->isValidArray(
            $this->associationSetMapping,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TAssociationSetMappingType'
        )
        ) {
            $msg = "Association set mapping array not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->associationSetMapping, $msg)) {
            return false;
        }
        if (!$this->isValidArray(
            $this->functionImportMapping,
            '\AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\TFunctionImportMappingType'
        )
        ) {
            $msg = "Function import mapping array not a valid array";
            return false;
        }
        if (!$this->isChildArrayOK($this->functionImportMapping, $msg)) {
            return false;
        }
        return true;
    }
}
