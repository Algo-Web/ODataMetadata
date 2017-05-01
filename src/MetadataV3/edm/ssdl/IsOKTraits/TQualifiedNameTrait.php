<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits;

use AlgoWeb\ODataMetadata\xsdRestrictions;

trait TQualifiedNameTrait
{
    public function isTQualifiedNameValid($string)
    {
        if (null == $string || empty($string)) {
            return false;
        }
        return true;
    }
}
