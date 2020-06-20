<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmSpatialTypeReference.
 *
 *  Represents a reference to an EDM spatial type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface ISpatialTypeReference extends IPrimitiveTypeReference
{
    /**
     * @return int|null gets the Spatial Reference Identifier of this spatial type
     */
    public function getSpatialReferenceIdentifier(): ?int;
}
