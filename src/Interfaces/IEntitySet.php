<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

interface IEntitySet extends IEntityContainerElement
{
    /**
     * @return IEntityType gets the entity type contained in this entity set
     */
    public function getElementType(): IEntityType;

    /**
     * @return array|INavigationTargetMapping[] gets the navigation targets of this entity set
     */
    public function getNavigationTargets(): array;

    /**
     * Finds the entity set that a navigation property targets.
     *
     * @param  INavigationProperty $navigationProperty the navigation property
     * @return IEntitySet|null     the entity set that the navigation propertion targets, or null if no such entity set exists
     */
    public function findNavigationTarget(INavigationProperty $navigationProperty): ?IEntitySet;
}
