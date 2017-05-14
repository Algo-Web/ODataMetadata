<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\xsdRestrictions;

trait TGuidLiteralTrait
{
    use xsdRestrictions;

    public function isTGuidLiteralValid($string)
    {
        //The below pattern represents the allowed identifiers in ECMA specification
        $regex = "/[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}/";
        return $this->matchesRegexPattern($regex, $string);
    }
}
