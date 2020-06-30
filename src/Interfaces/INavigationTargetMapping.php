<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

/**
 * Interface IEdmNavigationTargetMapping.
 *
 * Represents a mapping from an EDM navigation property to an entity set.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface INavigationTargetMapping
{
    /**
     * @return INavigationProperty gets the navigation property
     */
    public function getNavigationProperty(): INavigationProperty;

    /**
     * @return IEntitySet gets the target entity set
     */
    public function getTargetEntitySet(): IEntitySet;
}
