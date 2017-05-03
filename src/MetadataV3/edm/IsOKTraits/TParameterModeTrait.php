<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

trait TParameterModeTrait
{
    public function isTParameterModeValid($string)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException("Input must be a string");
        }
        return 'In' == $string || 'Out' == $string || 'InOut' == $string;
    }
}
