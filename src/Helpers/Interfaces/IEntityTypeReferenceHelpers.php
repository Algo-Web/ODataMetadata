<?php

declare(strict_types=1);

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
    public function entityDefinition(): IEntityType;

    /**
     * Gets the base type of the definition of this reference.
     *
     * @return IEntityType|null the base type of the definition of this reference
     */
    public function baseEntityType(): ?IEntityType;

    /**
     * Gets the entity key of the definition of this reference.
     *
     * @return IStructuralProperty[] the entity key of the definition of this reference
     */
    public function key(): array;

    /**
     * Gets the navigation properties declared in the definition of this reference and its base types.
     *
     * @return INavigationProperty[] The navigation properties declared in the definition of this reference and its base types
     */
    public function navigationProperties(): array;

    /**
     * Gets the navigation properties declared in the definition of this reference.
     *
     * @return INavigationProperty[] the navigation properties declared in the definition of this reference
     */
    public function declaredNavigationProperties(): array;

    /**
     * Finds a navigation property declared in the definition of this reference by name.
     *
     * @param  string                   $name name of the navigation property to find
     * @return INavigationProperty|null The requested navigation property if it exists. Otherwise, null.
     */
    public function findNavigationProperty(string $name): ?INavigationProperty;
}
