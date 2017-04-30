<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits;

use AlgoWeb\ODataMetadata\xsdRestrictions;

trait TQualifiedNameTrait
{
    use xsdRestrictions;

    public function isTQualifiedNameValid($string)
    {
        $regex = '[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}(\.[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}){0,}';
        return $this->matchesRegexPattern($regex, $string);
    }
}