<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits;

use AlgoWeb\ODataMetadata\xsdRestrictions;

/**
 * Trait TQualifiedNameTrait
 * Definition for QualifiedName. QualifiedName is SimpleIdentifiers with '.'
 * allowed. This is the same definition that is being used in the CSDL XSD
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\mapping\cs\IsOKTraits
 */
trait TQualifiedNameTrait
{
    use xsdRestrictions;

    public function isTQualifiedNameValid($string)
    {
        // The below pattern represents the allowed identifiers in ECMA specification plus the '.' for namespace qualification
        $regex = '/[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}(\.[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}){0,}/';
        return $this->matchesRegexPattern($regex, $string);
    }
}
