<?php

namespace MetadataV3\edm;

/**
 * Class representing TAssociationType
 *
 *
 * XSD Type: TAssociation
 */
class TAssociationType
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property \MetadataV3\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \MetadataV3\edm\TAssociationEndType[] $end
     */
    private $end = array(
        
    );

    /**
     * @property \MetadataV3\edm\TConstraintType $referentialConstraint
     */
    private $referentialConstraint = null;

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
     * Gets as documentation
     *
     * @return \MetadataV3\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param \MetadataV3\edm\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(\MetadataV3\edm\TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as end
     *
     * @return self
     * @param \MetadataV3\edm\TAssociationEndType $end
     */
    public function addToEnd(\MetadataV3\edm\TAssociationEndType $end)
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
     * @return \MetadataV3\edm\TAssociationEndType[]
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Sets a new end
     *
     * @param \MetadataV3\edm\TAssociationEndType[] $end
     * @return self
     */
    public function setEnd(array $end)
    {
        $this->end = $end;
        return $this;
    }

    /**
     * Gets as referentialConstraint
     *
     * @return \MetadataV3\edm\TConstraintType
     */
    public function getReferentialConstraint()
    {
        return $this->referentialConstraint;
    }

    /**
     * Sets a new referentialConstraint
     *
     * @param \MetadataV3\edm\TConstraintType $referentialConstraint
     * @return self
     */
    public function setReferentialConstraint(\MetadataV3\edm\TConstraintType $referentialConstraint)
    {
        $this->referentialConstraint = $referentialConstraint;
        return $this;
    }


}

