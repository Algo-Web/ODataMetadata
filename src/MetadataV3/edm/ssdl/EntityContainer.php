<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer\AssociationSetAnonymousType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer\EntitySetAnonymousType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TUndottedIdentifierTrait;

/**
 * Class representing EntityContainer
 */
class EntityContainer extends IsOK
{
    use TUndottedIdentifierTrait;
    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer\EntitySetAnonymousType[]
     * $entitySet
     */
    private $entitySet = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer\AssociationSetAnonymousType[]
     * $associationSet
     */
    private $associationSet = [];

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
            $msg = "Name cannot be null or empty";
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTUndottedIdentifierValid($name)) {
            $msg = "Name must be a valid TUndottedIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as documentation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $msg = null;
        if (!$documentation->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as entitySet
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer\EntitySetAnonymousType $entitySet
     */
    public function addToEntitySet(EntitySetAnonymousType $entitySet)
    {
        $msg = null;
        if (!$entitySet->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->entitySet[] = $entitySet;
        return $this;
    }

    /**
     * isset entitySet
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetEntitySet($index)
    {
        return isset($this->entitySet[$index]);
    }

    /**
     * unset entitySet
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEntitySet($index)
    {
        unset($this->entitySet[$index]);
    }

    /**
     * Gets as entitySet
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer\EntitySetAnonymousType[]
     */
    public function getEntitySet()
    {
        return $this->entitySet;
    }

    /**
     * Sets a new entitySet
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer\EntitySetAnonymousType[] $entitySet
     * @return self
     */
    public function setEntitySet(array $entitySet)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $entitySet,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer\EntitySetAnonymousType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->entitySet = $entitySet;
        return $this;
    }

    /**
     * Adds as associationSet
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer\AssociationSetAnonymousType
     * $associationSet
     */
    public function addToAssociationSet(AssociationSetAnonymousType $associationSet)
    {
        $msg = null;
        if (!$associationSet->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->associationSet[] = $associationSet;
        return $this;
    }

    /**
     * isset associationSet
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetAssociationSet($index)
    {
        return isset($this->associationSet[$index]);
    }

    /**
     * unset associationSet
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetAssociationSet($index)
    {
        unset($this->associationSet[$index]);
    }

    /**
     * Gets as associationSet
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer\AssociationSetAnonymousType[]
     */
    public function getAssociationSet()
    {
        return $this->associationSet;
    }

    /**
     * Sets a new associationSet
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer\AssociationSetAnonymousType[]
     * $associationSet
     * @return self
     */
    public function setAssociationSet(array $associationSet)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $associationSet,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer\AssociationSetAnonymousType',
            $msg
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->associationSet = $associationSet;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->name)) {
            $msg = "Name cannot be null or empty";
            return false;
        }
        if (!$this->isTUndottedIdentifierValid($this->name)) {
            $msg = "Name must be a valid TUndottedIdentifier";
            return false;
        }
        if (!$this->isObjectNullOrType(
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType',
            $this->documentation,
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->entitySet,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer\EntitySetAnonymousType',
            $msg
        )
        ) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->associationSet,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\EntityContainer\AssociationSetAnonymousType',
            $msg
        )
        ) {
            return false;
        }

        return true;
    }
}
