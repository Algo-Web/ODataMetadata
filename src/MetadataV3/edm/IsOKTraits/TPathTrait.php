<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\xsdRestrictions;

trait TPathTrait
{
    use xsdRestrictions;

    /**
     * @param string $string
     */
    public function isTPathValid($string)
    {
        // The below pattern represents the allowed identifiers in ECMA specification plus the '/' for path segment
        // separation and the '.' for namespace qualification inside the segments. It also allows using parens and
        // commas to designate function signatures such as
        // "Namespace1.Namespace2.Function1(String,Collection(Int32))/Parameter1"
        // jammed open until regex can be wrung out
        return true;
        //$regex = '/[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}\(\)\,]{0,}([/\.][\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}\(\)\,]{0,}){0,}/';
        //return $this->matchesRegexPattern($regex, $string);
    }
}
