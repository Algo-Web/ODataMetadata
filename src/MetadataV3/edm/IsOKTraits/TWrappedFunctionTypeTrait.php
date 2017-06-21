<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\xsdRestrictions;

trait TWrappedFunctionTypeTrait
{
    use TQualifiedNameTrait, xsdRestrictions {
        xsdRestrictions::isNCName insteadof TQualifiedNameTrait;
        xsdRestrictions::matchesRegexPattern insteadof TQualifiedNameTrait;
        xsdRestrictions::isName insteadof TQualifiedNameTrait;
    }

    public function isTWrappedFunctionTypeValid($string)
    {
        $regex = '/(Collection|Ref)\([^ \t]{1,}(\.[^ \t]{1,}){0,}\/)';

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
