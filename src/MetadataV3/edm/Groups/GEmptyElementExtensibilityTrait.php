<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\Groups;

use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType;

trait GEmptyElementExtensibilityTrait
{
    use IsOKToolboxTrait;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * Gets as documentation
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    public function isExtensibilityElementOK(&$msg = null)
    {
        if (!$this->isObjectNullOrType(
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType',
            $this->documentation
        )) {
            return false;
        }
        if (!$this->isObjectNullOrOK($this->documentation, $msg)) {
            return false;
        }
        return true;
    }
}