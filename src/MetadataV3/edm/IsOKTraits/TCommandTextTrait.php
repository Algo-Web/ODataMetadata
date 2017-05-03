<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits;

use AlgoWeb\ODataMetadata\StringTraits\XMLStringTrait;

trait TCommandTextTrait
{
    use XMLStringTrait;

    public function isTCommandTextValid($string)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException("Input must be a string");
        }
        return true;
    }
}
