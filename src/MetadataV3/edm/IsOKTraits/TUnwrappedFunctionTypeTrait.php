<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\xsdRestrictions;

trait TUnwrappedFunctionTypeTrait
{
    use TQualifiedNameTrait, xsdRestrictions {
        xsdRestrictions::isNCName insteadof TQualifiedNameTrait;
        xsdRestrictions::matchesRegexPattern insteadof TQualifiedNameTrait;
        xsdRestrictions::isName insteadof TQualifiedNameTrait;
    }

    public function isTUnwrappedFunctionTypeValid($string)
    {
        $regex = '/[^ \t]{1,}(\.[^ \t]{1,}){0,}/';

        if (!is_string($string)) {
            $msg = "Input must be a string: " . get_class($this);
            throw new \InvalidArgumentException($msg);
        }
        if ($this->isTQualifiedNameValid($string)) {
            return true;
        }
        return $this->matchesRegexPattern($regex, $string);
    }
}
