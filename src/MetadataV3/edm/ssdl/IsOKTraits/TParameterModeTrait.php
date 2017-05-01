<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\IsOKTraits;

trait TParameterModeTrait
{
    public function isTParameterModeValid($string)
    {
        if (!is_string($string)) {
            return false;
        }
        if ("In" == $string) {
            return true;
        }
        if ("Out" == $string) {
            return true;
        }
        if ("InOut" == $string) {
            return true;
        }
        return false;
    }
}
