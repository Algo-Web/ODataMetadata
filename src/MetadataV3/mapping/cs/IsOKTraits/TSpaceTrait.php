<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits;

trait TSpaceTrait
{
    public function isTSpaceValid($string)
    {
        return "C-S" == $string;
    }
}
