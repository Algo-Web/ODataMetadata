<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

trait TPropertyTypeTrait
{
    use EDMSimpleTypeTrait, TQualifiedNameTrait;

    public function isTPropertyTypeValid($string)
    {
        //The below pattern represents the allowed identifiers in ECMA specification
        // plus the '.' for namespace qualification
        $regex = "[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}(\.[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}){0,}";

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
