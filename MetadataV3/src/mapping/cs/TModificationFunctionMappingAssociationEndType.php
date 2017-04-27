<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

/**
 * Class representing TModificationFunctionMappingAssociationEndType
 *
 *
 * XSD Type: TModificationFunctionMappingAssociationEnd
 */
class TModificationFunctionMappingAssociationEndType
{

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
     * @property \MetadataV3\mapping\cs\TModificationFunctionMappingScalarPropertyType
     * $scalarProperty
     */
    private $scalarProperty = null;

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
     * @param string $associationSet
     * @return self
     */
    public function setAssociationSet($associationSet)
    {
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
     * @param string $from
     * @return self
     */
    public function setFrom($from)
    {
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
     * @param string $to
     * @return self
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * Gets as scalarProperty
     *
     * @return \MetadataV3\mapping\cs\TModificationFunctionMappingScalarPropertyType
     */
    public function getScalarProperty()
    {
        return $this->scalarProperty;
    }

    /**
     * Sets a new scalarProperty
     *
     * @param \MetadataV3\mapping\cs\TModificationFunctionMappingScalarPropertyType
     * $scalarProperty
     * @return self
     */
    public function setScalarProperty(\MetadataV3\mapping\cs\TModificationFunctionMappingScalarPropertyType $scalarProperty)
    {
        $this->scalarProperty = $scalarProperty;
        return $this;
    }
}
