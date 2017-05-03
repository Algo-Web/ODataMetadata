<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\xsdRestrictions;

trait TWrappedFunctionReturnTypeTrait
{
    use TQualifiedNameTrait, xsdRestrictions;

    public function isTWrappedFunctionTypeValid($string)
    {
        $regex = '(Collection|Ref)\([^ \t]{1,}(\.[^ \t]{1,}){0,}\)';

        if (!is_string($string)) {
            throw new \InvalidArgumentException("Input must be a string");
        }
        if ($this->isTQualifiedNameValid($string)) {
            return true;
        }
        return $this->matchesRegexPattern($regex, $string);
    }
}
