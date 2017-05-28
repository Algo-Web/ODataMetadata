<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\StringTraits\XSDTopLevelTrait;

trait TSridFacetTrait
{
    use XSDTopLevelTrait, TVariableTrait;

    public function isTSridFacetValid($string)
    {
        if ($this->isTVariableValid($string)) {
            return true;
        }
        $this->nonNegativeInteger($string);
        return true;
    }
}
