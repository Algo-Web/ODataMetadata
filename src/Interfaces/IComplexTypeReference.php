<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\ComplexTypeReferenceHelpers;

/**
 * Class IEdmComplexTypeReference.
 *
 * Represents references to EDM complex types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 * @mixin ComplexTypeReferenceHelpers
 */
interface IComplexTypeReference extends IStructuredTypeReference
{
}
