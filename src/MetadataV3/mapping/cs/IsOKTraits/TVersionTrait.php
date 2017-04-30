<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits;

trait TVersionTrait
{
    public function isTVersionValid($string)
    {
        $string = trim($string);
        if ('Original' == $string) {
            return true;
        }
        if ('Current' == $string) {
            return true;
        }
        return false;
    }
}