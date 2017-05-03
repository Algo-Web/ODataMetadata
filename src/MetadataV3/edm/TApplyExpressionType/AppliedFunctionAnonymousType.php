<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\MetadataV3\edm\Groups\GExpressionTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TAnonymousFunctionExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TEntitySetReferenceExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TIfExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TParameterReferenceExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyReferenceExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TRecordExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAssertExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeTestExpressionType;
use AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermReferenceExpressionType;

/**
 * Class representing AppliedFunctionAnonymousType
 */
class AppliedFunctionAnonymousType extends IsOK
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
