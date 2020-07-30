<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\Interfaces\IStructuredTypeReferenceHelpers;

/**
 * Interface IEdmStructuredTypeReference.
 *
 * Represents references to EDM structured types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IStructuredTypeReference extends ITypeReference, IStructuredTypeReferenceHelpers
{
}
