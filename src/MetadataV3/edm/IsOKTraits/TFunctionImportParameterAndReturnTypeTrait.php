<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\xsdRestrictions;

trait TFunctionImportParameterAndReturnTypeTrait
{
    use EDMSimpleTypeTrait, TQualifiedNameTrait, xsdRestrictions;

    public function isTFunctionImportParameterAndReturnTypeValid($string)
    {
        $regex = "Collection\([^ \t]{1,}(\.[^ \t]{1,}){0,}\)";

        if (!is_string($string)) {
            throw new \InvalidArgumentException("Input must be a string");
        }
        if ($this->isEDMSimpleTypeValid($string)) {
            return true;
        }
        if ($this->isTQualifiedNameValid($string)) {
            return true;
        }
        return $this->matchesRegexPattern($regex, $string);
    }
}
