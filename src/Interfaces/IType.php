<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Helpers\Interfaces\ITypeHelpers;
use AlgoWeb\ODataMetadata\Helpers\TypeHelpers;

/**
 * Interface IEdmType.
 *
 * Represents the definition of an EDM type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IType extends IEdmElement, ITypeHelpers
{
    /**
     * @return TypeKind gets the kind of this type
     */
    public function getTypeKind(): TypeKind;
}
