<?php


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmNavigationTargetMapping
 *
 * Represents a mapping from an EDM navigation property to an entity set.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface INavigationTargetMapping
{
    /**
     * @return INavigationProperty Gets the navigation property.
     */
    public function getNavigationProperty(): INavigationProperty;

    /**
     * @return IEntitySet Gets the target entity set.
     */
    public function getTargetEntitySet(): IEntitySet;

}