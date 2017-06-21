<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TTextType
 *
 * XSD Type: TText
 */
class TTextType extends IsOK
{
    public function isOK(&$msg = null)
    {
        return true;
    }
}
