<?php


namespace AlgoWeb\ODataMetadata\Interfaces;


interface IEntitySet extends IEntityContainerElement
{
    /**
     * @return IEntityType Gets the entity type contained in this entity set.
     */
    public function getElementType(): IEntityType;

    /**
     * @return array|INavigationTargetMapping[] Gets the navigation targets of this entity set.
     */
    public function getNavigationTargets(): array;

    /**
     * Finds the entity set that a navigation property targets.
     *
     * @param INavigationProperty $navigationProperty The navigation property.
     * @return IEntitySet|null The entity set that the navigation propertion targets, or null if no such entity set exists.
     */
    public function findNavigationTarget(INavigationProperty $navigationProperty): ?IEntitySet;
}