<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits;

use AlgoWeb\ODataMetadata\xsdRestrictions;

trait TSimpleIdentifierTrait
{
    use xsdRestrictions;

    public function isTSimpleIdentifierValid($string)
    {
        //The below pattern represents the allowed identifiers in ECMA specification
        $regex = '[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}';
        return $this->matchesRegexPattern($regex, $string);
    }
}