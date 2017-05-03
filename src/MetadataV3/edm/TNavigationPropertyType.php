<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GEmptyElementExtensibilityTrait;

/**
 * Class representing TNavigationPropertyType
 *
 *
 * XSD Type: TNavigationProperty
 */
class TNavigationPropertyType extends IsOK
{
    use GEmptyElementExtensibilityTrait;
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
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
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
     * @param string $relationship
     * @return self
     */
    public function setRelationship($relationship)
    {
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
     * @param string $toRole
     * @return self
     */
    public function setToRole($toRole)
    {
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
     * @param string $fromRole
     * @return self
     */
    public function setFromRole($fromRole)
    {
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
     * @param string $getterAccess
     * @return self
     */
    public function setGetterAccess($getterAccess)
    {
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
     * @param string $setterAccess
     * @return self
     */
    public function setSetterAccess($setterAccess)
    {
        $this->setterAccess = $setterAccess;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isExtensibilityElementOK($msg)) {
            return false;
        }
        return true;
    }
}
