<?php

namespace AlgoWeb\ODataMetadata\MetadataV4\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\xsdRestrictions;

trait TSimpleIdentifierTrait
{
    use xsdRestrictions;

    /**
     * @param string $tSimpleIdentifier
     */
    protected function isTSimpleIdentifierValid($tSimpleIdentifier)
    {
        if (!$this->isNCName($tSimpleIdentifier)) {
            $msg = 'Qualifier must be a valid NCName';
            return false;
        }
        if (strlen($tSimpleIdentifier > 128)) {
            $msg = 'The maximum length permitted for qualifier is 128';
            return false;
        }
        //      <!-- ECMAScript identifiers not starting with a '$' -->
        if (!$this->matchesRegexPattern(
            "[\p{L}\p{Nl}_][\p{L}\p{Nl}\p{Nd}\p{Mn}\p{Mc}\p{Pc}\p{Cf}]{0,}",
            $tSimpleIdentifier
        )
        ) {
            $msg = 'The qualifier does not match the regex in the xsd.';
            return false;
        }
        return true;
    }
}
