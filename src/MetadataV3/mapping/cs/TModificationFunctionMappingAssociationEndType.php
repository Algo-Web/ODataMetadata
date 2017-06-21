<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\Groups\TModificationFunctionMappingAssociationEndPropertyGroup;
use AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits\TSimpleIdentifierTrait;

/**
 * Class representing TModificationFunctionMappingAssociationEndType
 *
 * Type for function mapping association end
 *
 * XSD Type: TModificationFunctionMappingAssociationEnd
 */
class TModificationFunctionMappingAssociationEndType extends IsOK
{
    use TSimpleIdentifierTrait, TModificationFunctionMappingAssociationEndPropertyGroup;
    /**
     * @property string $associationSet
     */
    private $associationSet = null;

    /**
     * @property string $from
     */
    private $from = null;

    /**
     * @property string $to
     */
    private $to = null;

    /**
     * Gets as associationSet
     *
     * @return string
     */
    public function getAssociationSet()
    {
        return $this->associationSet;
    }

    /**
     * Sets a new associationSet
     *
     * @param  string $associationSet
     * @return self
     */
    public function setAssociationSet($associationSet)
    {
        if (!$this->isStringNotNullOrEmpty($associationSet)) {
            $msg = 'Association set cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        $this->associationSet = $associationSet;
        return $this;
    }

    /**
     * Gets as from
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Sets a new from
     *
     * @param  string $from
     * @return self
     */
    public function setFrom($from)
    {
        if (!$this->isStringNotNullOrEmpty($this->from)) {
            $msg = 'From cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        $this->from = $from;
        return $this;
    }

    /**
     * Gets as to
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Sets a new to
     *
     * @param  string $to
     * @return self
     */
    public function setTo($to)
    {
        if (!$this->isStringNotNullOrEmpty($this->to)) {
            $msg = 'To cannot be null or empty';
            throw new \InvalidArgumentException($msg);
        }
        $this->to = $to;
        return $this;
    }

    public function isOK(&$msg = null)
    {
        if (!$this->isStringNotNullOrEmpty($this->associationSet)) {
            $msg = 'Association set cannot be null or empty';
            return false;
        }
        if (!$this->isStringNotNullOrEmpty($this->from)) {
            $msg = 'From cannot be null or empty';
            return false;
        }
        if (!$this->isStringNotNullOrEmpty($this->to)) {
            $msg = 'To cannot be null or empty';
            return false;
        }
        if (!$this->isModificationFunctionMappingAssociationOK($msg)) {
            return false;
        }
        return true;
    }
}
