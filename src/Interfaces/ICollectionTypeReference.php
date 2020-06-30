<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\CollectionTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Helpers\Interfaces\ICollectionTypeReferenceHelpers;

/**
 * Interface IEdmCollectionTypeReference.
 *
 * Represents references to EDM Collection types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface ICollectionTypeReference extends ITypeReference, ICollectionTypeReferenceHelpers
{
}
