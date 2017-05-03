<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

trait TActionTrait
{
    public function isTActionValid($string)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException("Input must be a string");
        }
        return 'Cascade' == $string || 'None' == $string;
    }
}
