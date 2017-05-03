<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

class TCollationFacetTrait
{
    public function isTCollationFacetValid($input)
    {
        return is_string($input);
    }
}
