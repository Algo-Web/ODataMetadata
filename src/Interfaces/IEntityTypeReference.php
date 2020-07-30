<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\EntityTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Helpers\Interfaces\IEntityTypeReferenceHelpers;

/**
 * Interface IEdmEntityTypeReference.
 *
 * Represents references to entity types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IEntityTypeReference extends IStructuredTypeReference, IEntityTypeReferenceHelpers
{
}
