<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

trait TConcurrencyModeTrait
{
    public function isTConcurrencyModeValid($string)
    {
        if (!is_string($string)) {
            $msg = "Input must be a string: " . get_class($this);
            throw new \InvalidArgumentException($msg);
        }
        return 'Fixed' == $string || 'None' == $string;
    }
}
