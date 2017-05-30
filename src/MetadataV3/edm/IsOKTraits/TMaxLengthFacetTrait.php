<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\StringTraits\XSDTopLevelTrait;

trait TMaxLengthFacetTrait
{
    use TMaxTrait, XSDTopLevelTrait;

    public function isTMaxLengthFacetValid($string)
    {
        if ($this->isTMaxValid($string)) {
            return true;
        }
        return $this->nonNegativeInteger($string);
    }
}
