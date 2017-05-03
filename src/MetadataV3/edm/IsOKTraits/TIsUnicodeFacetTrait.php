<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

class TIsUnicodeFacetTrait
{
    public function isTIsUnicodeFacetTraitValid($input)
    {
        return $input === boolval($input);
    }
}
