<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\xsdRestrictions;

trait TQualifiedNameTrait
{
    use xsdRestrictions;

    public function isTQualifiedNameValid($string)
    {
        assert($this instanceof IsOK);
        if (!is_string($string)) {
            return false;
        }
        if (isset(self::$v3QualifiedNameCache[$string])) {
            return self::$v3QualifiedNameCache[$string];
        }
        // The below pattern represents the allowed identifiers in ECMA
        // specification plus the '.' for namespace qualification
        //$regex = '/[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}(\.[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}){0,}/';
        $result = $this->matchesRegexPattern(self::$v3QualifiedNameRegex, $string);
        self::$v3QualifiedNameCache[$string] = $result;
        return $result;
    }
}
