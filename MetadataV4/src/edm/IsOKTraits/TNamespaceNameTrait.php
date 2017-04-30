<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\xsdRestrictions;

trait TNamespaceNameTrait
{
    use xsdRestrictions;

    protected function IsTNamespaceNameValid($TNamespaceName)
    {
        if (!$this->isNCName($TNamespaceName)) {
            $msg = "Term Namespace Must be a valid NCName";
            return false;
        }
        //<!-- one or more SimpleIdentifiers separated by dots -->
        if (!$this->MatchesRegexPattern("[\p{L}\p{Nl}_][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}(\.[\p{L}\p{Nl}_][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}){0,}", $TNamespaceName)) {
            $msg = "the term namespace dose not match the regex in the xsd.";
            return false;
        }
        return true;
    }
}
