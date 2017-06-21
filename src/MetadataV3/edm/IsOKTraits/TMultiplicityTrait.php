<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

trait TMultiplicityTrait
{
    public function isTMultiplicityValid($string)
    {
        if (!is_string($string)) {
            $msg = "Input must be a string: " . get_class($this);
            throw new \InvalidArgumentException($msg);
        }
        return '0..1' == $string || '1' == $string || '*' == $string;
    }
}
