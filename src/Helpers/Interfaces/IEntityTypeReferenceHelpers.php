<?php

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;


use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;

/**
 * Class EntityTypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IEntityTypeReferenceHelpers
{
    /**
     * Gets the definition of this entity reference.
     *
     * @return IEntityType the definition of this entity reference
     */
    public function EntityDefinition(): IEntityType;

    /**
     * Gets the base type of the definition of this reference.
     *
     * @return IEntityType|null the base type of the definition of this reference
     */
    public function BaseEntityType(): ?IEntityType;

    /**
     * Gets the entity key of the definition of this reference.
     *
     * @return IStructuralProperty[] the entity key of the definition of this reference
     */
    public function Key(): array;

    /**
     * Gets the navigation properties declared in the definition of this reference and its base types.
     *
     * @return INavigationProperty[] The navigation properties declared in the definition of this reference and its base types
     */
    public function NavigationProperties(): array;

    /**
     * Gets the navigation properties declared in the definition of this reference.
     *
     * @return INavigationProperty[] the navigation properties declared in the definition of this reference
     */
    public function DeclaredNavigationProperties(): array;

    /**
     * Finds a navigation property declared in the definition of this reference by name.
     *
     * @param string $name name of the navigation property to find
     * @return INavigationProperty|null The requested navigation property if it exists. Otherwise, null.
     */
    public function FindNavigationProperty(string $name): ?INavigationProperty;
}