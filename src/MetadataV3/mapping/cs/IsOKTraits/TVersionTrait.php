<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits;

/**
 * Trait TVersionTrait
 * Definition for Version, which can 'original' or 'current' as its value
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits
 */
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
