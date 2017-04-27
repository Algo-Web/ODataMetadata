<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\edm\ssdl\EntityContainer\AssociationSetAnonymousType;

/**
 * Class representing EndAnonymousType
 */
class EndAnonymousType
{

    /**
     * @property string $role
     */
    private $role = null;

    /**
     * @property string $entitySet
     */
    private $entitySet = null;

    /**
     * @property \MetadataV2\edm\ssdl\TDocumentationType $documentation
     */
    private $documentation = null;

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
     * @param string $role
     * @return self
     */
    public function setRole($role)
    {
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
     * @param string $entitySet
     * @return self
     */
    public function setEntitySet($entitySet)
    {
        $this->entitySet = $entitySet;
        return $this;
    }

    /**
     * Gets as documentation
     *
     * @return \MetadataV2\edm\ssdl\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param \MetadataV2\edm\ssdl\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(\MetadataV2\edm\ssdl\TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }
}
