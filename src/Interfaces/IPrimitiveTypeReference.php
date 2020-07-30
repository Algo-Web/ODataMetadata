<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\Interfaces\IPrimitiveTypeReferenceHelpers;

/**
 * Interface IEdmPrimitiveTypeReference.
 *
 * Represents references to primitive types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IPrimitiveTypeReference extends ITypeReference, IPrimitiveTypeReferenceHelpers
{
}
