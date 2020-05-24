<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns;


use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasAnonymousFunctionExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasApplyExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasBinaryExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasBoolExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasCollectionExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasDateTimeExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasDateTimeOffsetExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasDecimalExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasEntitySetReferenceExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasEnumExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasFloatExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasFunctionReference;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasGuidExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasIfExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasIntExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasParameterReferenceExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasPathExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasPropertyReferenceExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasRecordExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasStringExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasTypeAssertExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasTypeTestExpression;
use AlgoWeb\ODataMetadata\MetadataV3\Edm\Concerns\Expressions\HasValueTermReferenceExpression;

trait HasExpression
{
    use HasValueTermReferenceExpression,
        HasAnonymousFunctionExpression,
        HasApplyExpression,
        HasBinaryExpression,
        HasBoolExpression,
        HasCollectionExpression,
        HasDateTimeExpression,
        HasDateTimeOffsetExpression,
        HasDecimalExpression,
        HasEntitySetReferenceExpression,
        HasEnumExpression,
        HasFloatExpression,
        HasFunctionReference,
        HasGuidExpression,
        HasIfExpression,
        HasIntExpression,
        HasParameterReferenceExpression,
        HasPathExpression,
        HasPropertyReferenceExpression,
        HasRecordExpression,
        HasStringExpression,
        HasTypeAssertExpression,
        HasTypeTestExpression;
}