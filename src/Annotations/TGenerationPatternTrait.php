<?php

namespace AlgoWeb\ODataMetadata\Annotations;

use AlgoWeb\ODataMetadata\StringTraits\XSDTopLevelTrait;

trait TGenerationPatternTrait
{
    use XSDTopLevelTrait;

    public function isTGenerationPatternValid($string)
    {
        if (!is_string($string)) {
            $msg = "Input must be a string: " . get_class($this);
            throw new \InvalidArgumentException($msg);
        }
        return 'None' == $string || 'Identity' == $string || 'Computed' == $string;
    }
}
