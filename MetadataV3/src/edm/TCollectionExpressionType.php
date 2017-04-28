<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;

/**
 * Class representing TCollectionExpressionType
 *
 *
 * XSD Type: TCollectionExpression
 */
class TCollectionExpressionType extends IsOK
{
    use \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\ValueTermReferenceTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\TypeTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\TypeAssertTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\StringTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\RecordTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\PropertyReferenceTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\PathTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\ParameterReferenceTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\IntTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\IfTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\GUIDTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\FunctionReferenceTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\FloatTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\EnumTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\EntitySetReferenceTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\DecimalTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\DateTimeTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\DateTimeOffsetTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\CollectionTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\BoolTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\BinaryTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\ApplyTrait,
        \AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits\AnonymousFunctionTrait;
}
