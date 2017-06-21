<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\CodeGeneration\AccessTypeTraits;
use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GEmptyElementExtensibilityTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TQualifiedNameTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TNavigationPropertyType
 *
 * XSD Type: TNavigationProperty
 */
class TNavigationPropertyType extends IsOK
{
    use GEmptyElementExtensibilityTrait,
        TQualifiedNameTrait,
        TSimpleIdentifierTrait,
        AccessTypeTraits {
        TSimpleIdentifierTrait::isNCName insteadof TQualifiedNameTrait;
        TSimpleIdentifierTrait::matchesRegexPattern insteadof TQualifiedNameTrait;
        TSimpleIdentifierTrait::isName insteadof TQualifiedNameTrait;
    }

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $relationship
     */
    private $relationship = null;

    /**
     * @property string $toRole
     */
    private $toRole = null;

    /**
     * @property string $fromRole
     */
    private $fromRole = null;

    /**
     * @property string $getterAccess
     */
    private $getterAccess = null;

    /**
     * @property string $setterAccess
     */
    private $setterAccess = null;

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
        if (!$this->isTSimpleIdentifierValid($name)) {
            $msg = "Name must be a valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as relationship
     *
     * @return string
     */
    public function getRelationship()
    {
        return $this->relationship;
    }

    /**
     * Sets a new relationship
     *
     * @param  string $relationship
     * @return self
     */
    public function setRelationship($relationship)
    {
        if (!$this->isTQualifiedNameValid($relationship)) {
            $msg = "Relationship must be a valid TQualifiedName";
            throw new \InvalidArgumentException($msg);
        }
        $this->relationship = $relationship;
        return $this;
    }

    /**
     * Gets as toRole
     *
     * @return string
     */
    public function getToRole()
    {
        return $this->toRole;
    }

    /**
     * Sets a new toRole
     *
     * @param  string $toRole
     * @return self
     */
    public function setToRole($toRole)
    {
        if (!$this->isTSimpleIdentifierValid($toRole)) {
            $msg = "To role must be a valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->toRole = $toRole;
        return $this;
    }

    /**
     * Gets as fromRole
     *
     * @return string
     */
    public function getFromRole()
    {
        return $this->fromRole;
    }

    /**
     * Sets a new fromRole
     *
     * @param  string $fromRole
     * @return self
     */
    public function setFromRole($fromRole)
    {
        if (!$this->isTSimpleIdentifierValid($fromRole)) {
            $msg = "From role must be a valid TSimpleIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->fromRole = $fromRole;
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
        if (null != $getterAccess && !$this->isTAccessOk($getterAccess)) {
            $msg = "Getter access must be a valid TAccess";
            throw new \InvalidArgumentException($msg);
        }
        $this->getterAccess = $getterAccess;
        return $this;
    }

    /**
     * Gets as setterAccess
     *
     * @return string
     */
    public function getSetterAccess()
    {
        return $this->setterAccess;
    }

    /**
     * Sets a new setterAccess
     *
     * @param  string $setterAccess
     * @return self
     */
    public function setSetterAccess($setterAccess)
    {
        if (null != $setterAccess && !$this->isTAccessOk($setterAccess)) {
            $msg = "Setter access must be a valid TAccess";
            throw new \InvalidArgumentException($msg);
        }
        $this->setterAccess = $setterAccess;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isTSimpleIdentifierValid($this->name)) {
            $msg = "Name must be a valid TSimpleIdentifier";
            return false;
        }
        if (!$this->isTQualifiedNameValid($this->relationship)) {
            $msg = "Relationship must be a valid TQualifiedName";
            return false;
        }
        if (!$this->isTSimpleIdentifierValid($this->toRole)) {
            $msg = "To role must be a valid TSimpleIdentifier";
            return false;
        }
        if (!$this->isTSimpleIdentifierValid($this->fromRole)) {
            $msg = "From role must be a valid TSimpleIdentifier";
            return false;
        }
        if (null != $this->getterAccess && !$this->isTAccessOk($this->getterAccess)) {
            $msg = "Getter access must be a valid TAccess";
            return false;
        }
        if (null != $this->setterAccess && !$this->isTAccessOk($this->setterAccess)) {
            $msg = "Setter access must be a valid TAccess";
            return false;
        }
        if (!$this->isExtensibilityElementOK($msg)) {
            return false;
        }
        return true;
    }
}
