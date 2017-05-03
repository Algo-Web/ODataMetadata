<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Groups;

use AlgoWeb\ODataMetadata\CodeGeneration\AccessTypeTraits;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TQualifiedNameTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;

trait TEntitySetAttributesTrait
{
    use TSimpleIdentifierTrait, TQualifiedNameTrait, AccessTypeTraits;
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
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
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
     * @param string $entityType
     * @return self
     */
    public function setEntityType($entityType)
    {
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
     * @param string $getterAccess
     * @return self
     */
    public function setGetterAccess($getterAccess)
    {
        $this->getterAccess = $getterAccess;
        return $this;
    }
    
    
    public function isTEntitySetAttributesOK(&$msg = null)
    {
        if (null != $this->name && !$this->isTSimpleIdentifierValid($this->name)) {
            $msg = "Name must be a valid TSimpleIdentifier";
            return false;
        }
        if (null != $this->entityType && !$this->isTQualifiedNameValid($this->entityType)) {
            $msg = "Entity type must be a valid TQualifiedName";
            return false;
        }
        if (null != $this->getterAccess && !$this->isTAccessOk($this->getterAccess)) {
            $msg = "Getter access must be a valid TAccess";
            return false;
        }

        return true;
    }
}
