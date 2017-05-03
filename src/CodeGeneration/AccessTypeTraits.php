<?php

namespace AlgoWeb\ODataMetadata\CodeGeneration;

trait AccessTypeTraits
{
    public function isTAccessOk($string)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException("Input must be a string");
        }
        return 'Public' == $string || 'Internal' == $string || 'Protected' == $string || 'Private' == $string;
    }

    public function isTPublicOrInternalAccessOK($string)
    {
        $result = $this->isTAccessOk($string);
        return $result && ('Public' == $string || 'Internal' == $string);
    }
}
