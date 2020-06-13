<?php


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmDecimalTypeReference
 *
 * Represents a reference to an EDM decimal type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IDecimalTypeReference extends IPrimitiveTypeReference
{
    /**
     * @return int|null Gets the precision of this type.
     */
    public function getPrecision(): ?int;

    /**
     * @return int|null Gets the scale of this type.
     */
    public function getScale(): ?int;
}