<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\ComplexTypeHelpers;
use AlgoWeb\ODataMetadata\Helpers\Interfaces\IComplexTypeHelpers;

/**
 * Interface IEdmComplexType.
 *
 *  Represents a definition of an EDM complex type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IComplexType extends IStructuredType, ISchemaType, ITerm, IComplexTypeHelpers
{
}
