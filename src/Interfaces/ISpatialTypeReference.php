<?php


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmSpatialTypeReference
 *
 *  Represents a reference to an EDM spatial type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface ISpatialTypeReference extends IPrimitiveTypeReference
{
    /**
     * @return int Gets the Spatial Reference Identifier of this spatial type.
     */
    public function getSpatialReferenceIdentifier(): int;
}