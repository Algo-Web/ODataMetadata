<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\ComplexTypeHelpers;

/**
 * Interface IEdmComplexType.
 *
 *  Represents a definition of an EDM complex type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 * @mixin ComplexTypeHelpers
 */
interface IComplexType extends IStructuredType, ISchemaType, ITerm
{
}
