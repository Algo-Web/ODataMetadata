<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\edm;

/**
 * Class representing TConstraintType
 *
 *
 * XSD Type: TConstraint
 */
class TConstraintType
{

    /**
     * @property \MetadataV2\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \MetadataV2\edm\TReferentialConstraintRoleElementType $principal
     */
    private $principal = null;

    /**
     * @property \MetadataV2\edm\TReferentialConstraintRoleElementType $dependent
     */
    private $dependent = null;

    /**
     * Gets as documentation
     *
     * @return \MetadataV2\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param \MetadataV2\edm\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(\MetadataV2\edm\TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Gets as principal
     *
     * @return \MetadataV2\edm\TReferentialConstraintRoleElementType
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * Sets a new principal
     *
     * @param \MetadataV2\edm\TReferentialConstraintRoleElementType $principal
     * @return self
     */
    public function setPrincipal(\MetadataV2\edm\TReferentialConstraintRoleElementType $principal)
    {
        $this->principal = $principal;
        return $this;
    }

    /**
     * Gets as dependent
     *
     * @return \MetadataV2\edm\TReferentialConstraintRoleElementType
     */
    public function getDependent()
    {
        return $this->dependent;
    }

    /**
     * Sets a new dependent
     *
     * @param \MetadataV2\edm\TReferentialConstraintRoleElementType $dependent
     * @return self
     */
    public function setDependent(\MetadataV2\edm\TReferentialConstraintRoleElementType $dependent)
    {
        $this->dependent = $dependent;
        return $this;
    }
}
