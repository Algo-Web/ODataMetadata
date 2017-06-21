<?php

namespace AlgoWeb\ODataMetadata\MetadataV2\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TReferenceTypeType
 *
 * XSD Type: TReferenceType
 */
class TReferenceTypeType extends IsOK
{

    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV2\edm\TDocumentationType $documentation
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
        $this->type = $type;
        return $this;
    }

    /**
     * Gets as documentation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV2\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV2\edm\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }
}
