<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\EnumTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Helpers\Interfaces\IEnumTypeReferenceHelpers;

/**
 * Interface IEdmEnumTypeReference.
 *
 * Represents references to EDM enumeration types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IEnumTypeReference extends ITypeReference, IEnumTypeReferenceHelpers
{
}
