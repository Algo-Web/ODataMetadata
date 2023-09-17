<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;

/**
 * Trait PrimitiveTypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait PrimitiveTypeReferenceHelpers
{
    /**
     * Gets the definition of this primitive type reference.
     *
     * @return IPrimitiveType definition of this primitive type reference
     */
    public function primitiveDefinition(): ?IPrimitiveType
    {
        /** @var IPrimitiveTypeReference $this */
        $pType = $this->getDefinition();
        assert($pType instanceof IPrimitiveType);
        return $pType;
    }

    /**
     * Gets the primitive kind of the definition referred to by this type reference.
     *
     * @return PrimitiveTypeKind primitive kind of the definition of this reference
     */
    public function primitiveKind(): PrimitiveTypeKind
    {
        $primitive = $this->primitiveDefinition();
        return $primitive !== null ? $primitive->getPrimitiveKind() : PrimitiveTypeKind::None();
    }
}
