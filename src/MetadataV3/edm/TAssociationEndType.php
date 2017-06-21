<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\TOperationsTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TQualifiedNameTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TMultiplicityTrait;

/**
 * Class representing TAssociationEndType
 *
 * XSD Type: TAssociationEnd
 */
class TAssociationEndType extends IsOK
{
    use TOperationsTrait, TQualifiedNameTrait, TSimpleIdentifierTrait, TMultiplicityTrait {
        TSimpleIdentifierTrait::isNCName insteadof TQualifiedNameTrait;
        TSimpleIdentifierTrait::matchesRegexPattern insteadof TQualifiedNameTrait;
        TSimpleIdentifierTrait::isName insteadof TQualifiedNameTrait;
    }
    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property string $role
     */
    private $role = null;

    /**
     * @property string $multiplicity
     */
    private $multiplicity = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * Gets as type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets a new type
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        if (!$this->isTQualifiedNameValid($type)) {
            $msg = "Type must be a valid TQualifiedName";
            throw new \InvalidArgumentException($msg);
        }
        $this->type = $type;
        return $this;
    }

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
     * Gets as multiplicity
     *
     * @return string
     */
    public function getMultiplicity()
    {
        return $this->multiplicity;
    }

    /**
     * Sets a new multiplicity
     *
     * @param  string $multiplicity
     * @return self
     */
    public function setMultiplicity($multiplicity)
    {
        if (null != $multiplicity && !$this->isTMultiplicityValid($multiplicity)) {
            $msg = "Multiplicity must be a valid TMultiplicity";
            throw new \InvalidArgumentException($msg);
        }
        $this->multiplicity = $multiplicity;
        return $this;
    }

    /**
     * Gets as documentation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
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

    public function isOK(&$msg = null)
    {
        if (!$this->isTQualifiedNameValid($this->type)) {
            $msg = "Type must be a valid TQualifiedName";
            return false;
        }
        if (null != $this->role && !$this->isTSimpleIdentifierValid($this->role)) {
            $msg = "Role must be a valid TSimpleIdentifier";
            return false;
        }
        if (null != $this->multiplicity && !$this->isTMultiplicityValid($this->multiplicity)) {
            $msg = "Multiplicity must be a valid TMultiplicity";
            return false;
        }
        if (!$this->isObjectNullOrOK($this->documentation, $msg)) {
            return false;
        }

        if (!$this->isTOperationsOK($msg)) {
            return false;
        }
        return true;
    }
}
