<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm\IsOKTraits;


trait TSimpleIdentifierTrait
{
    use xsdRestrictions;

    protected function IsTSimpleIdentifierValid($TSimpleIdentifier)
    {
        if (!$this->isNCName($TSimpleIdentifier)) {
            $msg = "qualifier Must be a valid NCName";
            return false;
        }
        if (strlen($TSimpleIdentifier > 128)) {
            $msg = "the maximum length permitted for qualifier is 128";
            return false;
        }
        //      <!-- ECMAScript identifiers not starting with a '$' -->
        if (!$this->MatchesRegexPattern("[\p{L}\p{Nl}_][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}", $TSimpleIdentifier)) {
            $msg = "the qualifier dose not match the regex in the xsd.";
            return false;
        }
        return true;
    }
}