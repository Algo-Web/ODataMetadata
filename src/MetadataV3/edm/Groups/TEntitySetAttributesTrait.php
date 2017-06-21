<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Groups;

use AlgoWeb\ODataMetadata\CodeGeneration\AccessTypeTraits;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TQualifiedNameTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;

trait TEntitySetAttributesTrait
{
    use TSimpleIdentifierTrait, TQualifiedNameTrait, AccessTypeTraits{
        TSimpleIdentifierTrait::isNCName insteadof TQualifiedNameTrait;
        TSimpleIdentifierTrait::matchesRegexPattern insteadof TQualifiedNameTrait;
        TSimpleIdentifierTrait::isName insteadof TQualifiedNameTrait;
    }

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $entityType
     */
    private $entityType = null;

    /**
     * @property string $getterAccess
     */
    private $getterAccess = null;

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
        $msg = null;
        if (null != $name && !$this->isTSimpleIdentifierValid($name)) {
            $msg = "Name must be a valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as entityType
     *
     * @return string
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * Sets a new entityType
     *
     * @param  string $entityType
     * @return self
     */
    public function setEntityType($entityType)
    {
        $msg = null;
        if (null != $entityType && !$this->isTQualifiedNameValid($entityType)) {
            $msg = "Entity type must be a valid TQualifiedName";
            throw new \InvalidArgumentException($msg);
        }
        $this->entityType = $entityType;
        return $this;
    }

    /**
     * Gets as getterAccess
     *
     * @return string
     */
    public function getGetterAccess()
    {
        return $this->getterAccess;
    }

    /**
     * Sets a new getterAccess
     *
     * @param  string $getterAccess
     * @return self
     */
    public function setGetterAccess($getterAccess)
    {
        $msg = null;
        if (null != $getterAccess && !$this->isTAccessOk($getterAccess)) {
            $msg = "Getter access must be a valid TAccess";
            throw new \InvalidArgumentException($msg);
        }
        $this->getterAccess = $getterAccess;
        return $this;
    }
    
    
    public function isTEntitySetAttributesOK(&$msg = null)
    {
        if (null != $this->name && !$this->isTSimpleIdentifierValid($this->name)) {
            $msg = "Name must be a valid TSimpleIdentifier: " . get_class($this);
            return false;
        }
        if (null != $this->entityType && !$this->isTQualifiedNameValid($this->entityType)) {
            $msg = "Entity type must be a valid TQualifiedName: " . get_class($this);
            return false;
        }
        if (null != $this->getterAccess && !$this->isTAccessOk($this->getterAccess)) {
            $msg = "Getter access must be a valid TAccess: " . get_class($this);
            return false;
        }

        return true;
    }
}
