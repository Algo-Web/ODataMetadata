<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

trait TParameterModeTrait
{
    public function isTParameterModeValid($string)
    {
        if (!is_string($string)) {
            $msg = "Input must be a string: " . get_class($this);
            throw new \InvalidArgumentException($msg);
        }
        return 'In' == $string || 'Out' == $string || 'InOut' == $string;
    }
}
