<?php
/**
 * Created by PhpStorm.
 * User: Doc
 * Date: 5/1/2017
 * Time: 8:59 PM
 */

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits;

trait TCommandTextTrait
{
    public function isTCommandTextValid($string)
    {
        if (null == $string || empty($string)) {
            return false;
        }
        return true;
    }
}
