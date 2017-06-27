<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

trait TPropertyTypeTrait
{
    use EDMSimpleTypeTrait, TQualifiedNameTrait;

    protected static $v3PropertyTypeCache = [];
    protected static $v3PropertyTypeRegex =
        "/[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}(\.[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}){0,}/";

    public function isTPropertyTypeValid($string)
    {
        //The below pattern represents the allowed identifiers in ECMA specification
        // plus the '.' for namespace qualification
        //$regex = "/[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}(\.[\p{L}\p{Nl}][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}){0,}/";

        if (!is_string($string)) {
            $msg = "Input must be a string: " . get_class($this);
            throw new \InvalidArgumentException($msg);
        }
        if ($this->isEDMSimpleTypeValid($string)) {
            return true;
        }
        if ($this->isTQualifiedNameValid($string)) {
            return true;
        }
        return $this->matchesRegexPattern(static::$v3PropertyTypeRegex, $string);
    }
}
