<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

trait TActionTrait
{
    public function isTActionValid($string)
    {
        if (!is_string($string)) {
            $msg = "Input must be a string: " . get_class($this);
            throw new \InvalidArgumentException($msg);
        }
        return 'Cascade' == $string || 'None' == $string;
    }
}
