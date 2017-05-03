<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

class TIsFixedLengthFacetTrait
{
    public function isTIsFixedLengthFacetTraitValid($input)
    {
        return $input === boolval($input);
    }
}
