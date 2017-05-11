<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GBaseExpressionTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GExpressionTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TAnonymousFunctionExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType;

/**
 * Class representing AppliedFunctionAnonymousType
 */
class AppliedFunctionAnonymousType extends IsOK
{
    use GBaseExpressionTrait, GExpressionTrait;

    public function isOK(&$msg = null)
    {
        if (!$this->isGExpressionValid($msg)) {
            return false;
        }
        return true;
    }
}
