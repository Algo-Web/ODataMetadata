<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmTemporalTypeReference.
 *
 * Represents a reference to an EDM temporal (Time, DateTime, DateTimeOffset) type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface ITemporalTypeReference extends IPrimitiveTypeReference
{
    /**
     * @return int|null gets the precision of this temporal type
     */
    public function getPrecision(): ?int;
}
