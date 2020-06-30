<?php

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;


use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;

/**
 * Trait PrimitiveTypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IPrimitiveTypeReferenceHelpers
{
    /**
     * Gets the definition of this primitive type reference.
     *
     * @return IPrimitiveType definition of this primitive type reference
     */
    public function PrimitiveDefinition(): ?IPrimitiveType;

    /**
     * Gets the primitive kind of the definition referred to by this type reference.
     *
     * @return PrimitiveTypeKind primitive kind of the definition of this reference
     */
    public function PrimitiveKind(): PrimitiveTypeKind;
}