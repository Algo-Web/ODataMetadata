<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\EntityContainer\AssociationSetAnonymousType;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GEmptyElementExtensibilityTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing EndAnonymousType
 */
class EndAnonymousType extends IsOK
{
    //1. The number of Ends has to match with ones defined in AssociationType
    //2. Value for attribute Name should match the defined ones and EntitySet should be of the
    //   defined Entity Type in AssociationType
    
    use TSimpleIdentifierTrait, GEmptyElementExtensibilityTrait;
    /**
     * @property string $role
     */
    private $role = null;

    /**
     * @property string $entitySet
     */
    private $entitySet = null;

    /**
     * Gets as role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Sets a new role
     *
     * @param  string $role
     * @return self
     */
    public function setRole($role)
    {
        if (null != $role && !$this->isTSimpleIdentifierValid($role)) {
            $msg = "Role must be a valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->role = $role;
        return $this;
    }

    /**
     * Gets as entitySet
     *
     * @return string
     */
    public function getEntitySet()
    {
        return $this->entitySet;
    }

    /**
     * Sets a new entitySet
     *
     * @param  string $entitySet
     * @return self
     */
    public function setEntitySet($entitySet)
    {
        $msg = null;
        if (!$this->isTSimpleIdentifierValid($entitySet)) {
            $msg = "Entity set must be a valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->entitySet = $entitySet;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isTSimpleIdentifierValid($this->entitySet)) {
            $msg = "Entity set must be a valid TSimpleIdentifier";
            return false;
        }
        if (null != $this->role && !$this->isTSimpleIdentifierValid($this->role)) {
            $msg = "Role must be a valid TSimpleIdentifier";
            return false;
        }
        if (!$this->isExtensibilityElementOK($msg)) {
            return false;
        }

        return true;
    }
}
