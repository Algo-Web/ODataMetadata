<?php
/**
 * Created by PhpStorm.
 * User: Doc
 * Date: 5/1/2017
 * Time: 8:44 PM
 */

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits;

trait TSimpleIdentifierTrait
{
    public function isTSimpleIdentifierValid($string)
    {
        if (null == $string || empty($string)) {
            return false;
        }
        return true;
    }
}
