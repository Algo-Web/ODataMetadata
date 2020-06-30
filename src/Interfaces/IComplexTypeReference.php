<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\ComplexTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Helpers\Interfaces\IComplexTypeReferenceHelpers;

/**
 * Class IEdmComplexTypeReference.
 *
 * Represents references to EDM complex types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IComplexTypeReference extends IStructuredTypeReference, IComplexTypeReferenceHelpers
{
}
