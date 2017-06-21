<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TMultiplicityTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TQualifiedNameTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TAssociationEndType
 *
 * XSD Type: TAssociationEnd
 */
class TAssociationEndType extends IsOK
{
    use TSimpleIdentifierTrait, TQualifiedNameTrait, TMultiplicityTrait, TOperations;
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
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType $documentation
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
        if (!$this->isStringNotNullOrEmpty($type)) {
            $msg = "Type cannot be null or empty";
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
        if (null != $role && !$this->isStringNotNullOrEmpty($role)) {
            $msg = "Role cannot be empty";
            throw new \InvalidArgumentException($msg);
        }
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
        $msg = null;
        if (!$this->isStringNotNullOrEmpty($multiplicity)) {
            $msg = "Multiplicity cannot be null or empty";
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTMultiplicityValid($multiplicity)) {
            $msg = "Multiplicity must be a valid TMultiplicity";
            throw new \InvalidArgumentException($msg);
        }
        $this->multiplicity = $multiplicity;
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
    
    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->type)) {
            $msg = "Type cannot be null or empty";
            return false;
        }
        if (!$this->isStringNotNullOrEmpty($this->multiplicity)) {
            $msg = "Multiplicity cannot be null or empty";
            return false;
        }
        if (null != $this->role && !$this->isStringNotNullOrEmpty($this->role)) {
            $msg = "Role cannot be empty";
            return false;
        }
        if (null != $this->role && !$this->isTSimpleIdentifierValid($this->role)) {
            $msg = "Role must be a valid TSimpleIdentifier";
            return false;
        }
        if (!$this->isTMultiplicityValid($this->multiplicity)) {
            $msg = "Multiplicity must be a valid TMultiplicity";
            return false;
        }
        if (!$this->isOperationsGroupOK($msg)) {
            return false;
        }

        return true;
    }
}
