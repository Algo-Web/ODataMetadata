<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GExpressionTrait;

/**
 * Class representing TCollectionExpressionType
 *
 *
 * XSD Type: TCollectionExpression
 */
class TCollectionExpressionType extends IsOK
{
    use GExpressionTrait;

    public function isOK(&$msg = null)
    {
        if (!$this->isGExpressionValid($msg)) {
            return false;
        }
        return true;
    }
}
