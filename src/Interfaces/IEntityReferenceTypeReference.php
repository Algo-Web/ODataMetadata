<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\EntityReferenceTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Helpers\Interfaces\IEntityReferenceTypeReferenceHelpers;

/**
 * Interface IEdmEntityReferenceTypeReference.
 *
 * Represents references to entity reference types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IEntityReferenceTypeReference extends ITypeReference, IEntityReferenceTypeReferenceHelpers
{
}
