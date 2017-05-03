<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\StringTraits\XSDTopLevelTrait;

trait TPrecisionFacetTrait
{
    use XSDTopLevelTrait;

    public function isTPrecisionFacetValid($string)
    {
        return $this->nonNegativeInteger($string);
    }
}
