<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

trait TConcurrencyModeTrait
{
    public function isTConcurrencyModeValid($string)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException("Input must be a string");
        }
        return 'Fixed' == $string || 'None' == $string;
    }
}
