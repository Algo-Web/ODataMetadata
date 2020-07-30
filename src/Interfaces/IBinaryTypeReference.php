<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmBinaryTypeReference.
 *
 * Represents a reference to an EDM binary type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IBinaryTypeReference extends IPrimitiveTypeReference
{
    /**
     * @return bool|null gets a value indicating whether this type specifies fixed length
     */
    public function isFixedLength(): ?bool;

    /**
     * @return bool gets a value indicating whether this type specifies the maximum allowed length
     */
    public function isUnBounded(): bool;

    /**
     * @return int|null gets the maximum length of this type
     */
    public function getMaxLength(): ?int;
}
