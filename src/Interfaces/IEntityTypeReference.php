<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\EntityTypeReferenceHelpers;

/**
 * Interface IEdmEntityTypeReference.
 *
 * Represents references to entity types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 * @mixin EntityTypeReferenceHelpers
 */
interface IEntityTypeReference extends IStructuredTypeReference
{
}
