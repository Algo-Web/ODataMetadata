<?php


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\EdmElementHelpers;
use AlgoWeb\ODataMetadata\Helpers\TypeReferenceHelpers;

/**
 * Interface IEdmTypeReference
 *
 *  Represents a references to a type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 * @mixin TypeReferenceHelpers
 * @mixin EdmElementHelpers
 */
interface ITypeReference extends IEdmElement
{
    /**
     * @return bool Gets a value indicating whether this type is nullable.
     */
    public function getNullable(): bool;

    /**
     * @return IType|null Gets the definition to which this type refers.
     */
    public function getDefinition(): ?IType;
}