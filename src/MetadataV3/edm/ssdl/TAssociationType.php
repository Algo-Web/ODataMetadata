<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits\TUndottedIdentifierTrait;

/**
 * Class representing TAssociationType
 *
 * XSD Type: TAssociation
 */
class TAssociationType extends IsOK
{
    use TUndottedIdentifierTrait;
    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TAssociationEndType[] $end
     */
    private $end = [];

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TConstraintType $referentialConstraint
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
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        if (!$this->isStringNotNullOrEmpty($name)) {
            $msg = "Name cannot be null or empty";
            throw new \InvalidArgumentException($msg);
        }
        if (!$this->isTUndottedIdentifierValid($name)) {
            $msg = "Name must be a valid TUndottedIdentifier";
            throw new \InvalidArgumentException($msg);
        }
        $this->name = $name;
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

    /**
     * Adds as end
     *
     * @return self
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TAssociationEndType $end
     */
    public function addToEnd(TAssociationEndType $end)
    {
        $msg = null;
        if (!$end->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->end[] = $end;
        return $this;
    }

    /**
     * isset end
     *
     * @param  scalar $index
     * @return boolean
     */
    public function issetEnd($index)
    {
        return isset($this->end[$index]);
    }

    /**
     * unset end
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEnd($index)
    {
        unset($this->end[$index]);
    }

    /**
     * Gets as end
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TAssociationEndType[]
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Sets a new end
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TAssociationEndType[] $end
     * @return self
     */
    public function setEnd(array $end)
    {
        $msg = null;
        if (!$this->isValidArrayOK(
            $end,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TAssociationEndType',
            $msg,
            2,
            2
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->end = $end;
        return $this;
    }

    /**
     * Gets as referentialConstraint
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TConstraintType
     */
    public function getReferentialConstraint()
    {
        return $this->referentialConstraint;
    }

    /**
     * Sets a new referentialConstraint
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TConstraintType $referentialConstraint
     * @return self
     */
    public function setReferentialConstraint(TConstraintType $referentialConstraint)
    {
        $msg = null;
        if (!$referentialConstraint->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->referentialConstraint = $referentialConstraint;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->name)) {
            $msg = "Name cannot be null or empty";
            return false;
        }
        if (!$this->isTUndottedIdentifierValid($this->name)) {
            $msg = "Name must be a valid TUndottedIdentifier";
            return false;
        }
        if (!$this->isObjectNullOrOK($this->referentialConstraint, $msg)) {
            return false;
        }
        if (!$this->isObjectNullOrOK($this->documentation, $msg)) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->end,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TAssociationEndType',
            $msg,
            2,
            2
        )
        ) {
            return false;
        }

        return true;
    }
}
