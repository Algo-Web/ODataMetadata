<?php
/**
 * Created by PhpStorm.
 * User: Doc
 * Date: 5/1/2017
 * Time: 11:45 PM
 */

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits;

trait TActionTrait
{
    public function isTActionValid($string)
    {
        if ("Cascade" == $string) {
            return true;
        }
        if ("Restrict" == $string) {
            return true;
        }
        if ("None" == $string) {
            return true;
        }
        return false;
    }
}
