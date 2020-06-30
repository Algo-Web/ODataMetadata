<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Helpers\Interfaces\IPrimitiveTypeHelpers;

/**
 * Interface IEdmPrimitiveType.
 *
 *Represents a definition of an EDM primitive type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IPrimitiveType extends ISchemaType, IPrimitiveTypeHelpers
{
    /**
     * @return PrimitiveTypeKind gets the primitive kind of this type
     */
    public function getPrimitiveKind(): PrimitiveTypeKind;
}
