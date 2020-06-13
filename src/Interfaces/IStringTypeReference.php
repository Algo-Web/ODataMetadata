<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmStringTypeReference.
 *
 * Represents a reference to an EDM string type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IStringTypeReference extends IPrimitiveTypeReference
{
    /**
     * @return bool|null gets a value indicating whether this string type specifies fixed length
     */
    public function isFixedLength(): ?bool;

    /**
     * @return bool gets a value indicating whether this string type specifies the maximum allowed length
     */
    public function isUnbounded(): bool;

    /**
     * @return int|null gets the maximum length of this string type
     */
    public function getMaxLength(): ?int;

    /**
     * @return bool|null gets a value indicating whether this string type supports unicode encoding
     */
    public function isUnicode(): ?bool;

    /**
     * @return string|null gets a string representing the collation of this string type
     */
    public function getCollation(): ?string;
}
