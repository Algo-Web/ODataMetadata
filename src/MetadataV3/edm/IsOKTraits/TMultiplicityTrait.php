<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

trait TMultiplicityModeTrait
{
    public function isTMultiplicityValid($string)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException("Input must be a string");
        }
        return '0..1' == $string || '1' == $string || '*' == $string;
    }
}
