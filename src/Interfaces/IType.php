<?php


namespace AlgoWeb\ODataMetadata\Interfaces;


use AlgoWeb\ODataMetadata\Enums\TypeKind;

/**
 * Interface IEdmType
 *
 * Represents the definition of an EDM type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IType extends IEdmElement
{
    /**
     * @return TypeKind Gets the kind of this type.
     */
    public function getTypeKind(): TypeKind;
}