<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

trait TVariableTrait
{
    public function isTVariableValid($string)
    {
        return 'Variable' === $string;
    }
}
