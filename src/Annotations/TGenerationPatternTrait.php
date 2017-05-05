<?php

namespace AlgoWeb\ODataMetadata\Annotations;

use AlgoWeb\ODataMetadata\StringTraits\XSDTopLevelTrait;

trait TGenerationPatternTrait
{
    use XSDTopLevelTrait;

    public function isTGenerationPatternValid($string)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException("Input must be a string");
        }
        return 'None' == $string || 'Identity' == $string || 'Computed' == $string;
    }
}