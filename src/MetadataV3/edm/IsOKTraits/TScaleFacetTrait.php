<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\StringTraits\XSDTopLevelTrait;

class TScaleFacetTrait
{
    use XSDTopLevelTrait;

    public function isTScaleFacetValid($string)
    {
        return $this->nonNegativeInteger($string);
    }
}
