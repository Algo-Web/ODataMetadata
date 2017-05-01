<?php
/**
 * Created by PhpStorm.
 * User: Doc
 * Date: 5/1/2017
 * Time: 11:40 PM
 */

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits;

trait TParameterTypeSemanticsTrait
{
    public function isTParameterTypeSemanticsValid($string)
    {
        if ("ExactMatchOnly" == $string) {
            return true;
        }
        if ("AllowImplicitPromotion" == $string) {
            return true;
        }
        if ("AllowImplicitConversion" == $string) {
            return true;
        }
        return false;
    }
}
