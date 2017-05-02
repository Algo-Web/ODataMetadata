<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits;

use AlgoWeb\ODataMetadata\xsdRestrictions;

// This is the same definition that is being used in the CSDL XSD
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
