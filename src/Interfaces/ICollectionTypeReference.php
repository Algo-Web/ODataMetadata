<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\CollectionTypeReferenceHelpers;

/**
 * Interface IEdmCollectionTypeReference.
 *
 * Represents references to EDM Collection types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 * @mixin CollectionTypeReferenceHelpers
 */
interface ICollectionTypeReference extends ITypeReference
{
}
