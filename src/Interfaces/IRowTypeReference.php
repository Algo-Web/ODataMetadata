<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\Interfaces\IRowTypeReferenceHelpers;
use AlgoWeb\ODataMetadata\Helpers\RowTypeReferenceHelpers;

/**
 * Class IEdmRowTypeReference.
 *
 * Represents references to row types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IRowTypeReference extends IStructuredTypeReference, IRowTypeReferenceHelpers
{
}
