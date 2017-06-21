<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\xsdRestrictions;

trait TNamespaceNameTrait
{
    use xsdRestrictions;

    /**
     * @param string $TNamespaceName
     */
    protected function isTNamespaceNameValid($TNamespaceName)
    {
        if (!$this->isNCName($TNamespaceName)) {
            $msg = "Term namespace must be a valid NCName";
            return false;
        }
        //<!-- one or more SimpleIdentifiers separated by dots -->
        if (!$this->matchesRegexPattern(
            "[\p{L}\p{Nl}_][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}(\.[\p{L}\p{Nl}_][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}){0,}",
            $TNamespaceName
        )
        ) {
            $msg = "The term namespace does not match the regex in the xsd.";
            return false;
        }
        return true;
    }
}
