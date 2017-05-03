<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\StringTraits\XSDTopLevelTrait;

trait TScaleFacetTrait
{
    use XSDTopLevelTrait;

    public function isTScaleFacetValid($string)
    {
        return $this->nonNegativeInteger($string);
    }
}
