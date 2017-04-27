<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\edm\EntityContainer;

/**
 * Class representing AssociationSetAnonymousType
 */
class AssociationSetAnonymousType
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $association
     */
    private $association = null;

    /**
     * @property \MetadataV2\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property
     * \MetadataV2\edm\EntityContainer\AssociationSetAnonymousType\EndAnonymousType[]
     * $end
     */
    private $end = array(
        
    );

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
     * Gets as association
     *
     * @return string
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Sets a new association
     *
     * @param string $association
     * @return self
     */
    public function setAssociation($association)
    {
        $this->association = $association;
        return $this;
    }

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
     * Adds as end
     *
     * @return self
     * @param
     * \MetadataV2\edm\EntityContainer\AssociationSetAnonymousType\EndAnonymousType
     * $end
     */
    public function addToEnd(\MetadataV2\edm\EntityContainer\AssociationSetAnonymousType\EndAnonymousType $end)
    {
        $this->end[] = $end;
        return $this;
    }

    /**
     * isset end
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetEnd($index)
    {
        return isset($this->end[$index]);
    }

    /**
     * unset end
     *
     * @param scalar $index
     * @return void
     */
    public function unsetEnd($index)
    {
        unset($this->end[$index]);
    }

    /**
     * Gets as end
     *
     * @return
     * \MetadataV2\edm\EntityContainer\AssociationSetAnonymousType\EndAnonymousType[]
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Sets a new end
     *
     * @param
     * \MetadataV2\edm\EntityContainer\AssociationSetAnonymousType\EndAnonymousType[]
     * $end
     * @return self
     */
    public function setEnd(array $end)
    {
        $this->end = $end;
        return $this;
    }
}
