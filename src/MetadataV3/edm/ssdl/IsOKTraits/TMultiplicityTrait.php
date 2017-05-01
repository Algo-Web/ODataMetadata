<?php
/**
 * Created by PhpStorm.
 * User: Doc
 * Date: 5/1/2017
 * Time: 9:05 PM
 */

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits;

trait TMultiplicityTrait
{
    public function isTMultiplicityValid($string)
    {
        if ("0..1" == $string) {
            return true;
        }
        if ("1" == $string) {
            return true;
        }
        if ("*" == $string) {
            return true;
        }
        return false;
    }
}
