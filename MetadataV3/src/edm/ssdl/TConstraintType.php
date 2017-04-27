<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

/**
 * Class representing TConstraintType
 *
 *
 * XSD Type: TConstraint
 */
class TConstraintType
{

    /**
     * @property \MetadataV3\edm\ssdl\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \MetadataV3\edm\ssdl\TReferentialConstraintRoleElementType $principal
     */
    private $principal = null;

    /**
     * @property \MetadataV3\edm\ssdl\TReferentialConstraintRoleElementType $dependent
     */
    private $dependent = null;

    /**
     * Gets as documentation
     *
     * @return \MetadataV3\edm\ssdl\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param \MetadataV3\edm\ssdl\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(\MetadataV3\edm\ssdl\TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Gets as principal
     *
     * @return \MetadataV3\edm\ssdl\TReferentialConstraintRoleElementType
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * Sets a new principal
     *
     * @param \MetadataV3\edm\ssdl\TReferentialConstraintRoleElementType $principal
     * @return self
     */
    public function setPrincipal(\MetadataV3\edm\ssdl\TReferentialConstraintRoleElementType $principal)
    {
        $this->principal = $principal;
        return $this;
    }

    /**
     * Gets as dependent
     *
     * @return \MetadataV3\edm\ssdl\TReferentialConstraintRoleElementType
     */
    public function getDependent()
    {
        return $this->dependent;
    }

    /**
     * Sets a new dependent
     *
     * @param \MetadataV3\edm\ssdl\TReferentialConstraintRoleElementType $dependent
     * @return self
     */
    public function setDependent(\MetadataV3\edm\ssdl\TReferentialConstraintRoleElementType $dependent)
    {
        $this->dependent = $dependent;
        return $this;
    }
}
