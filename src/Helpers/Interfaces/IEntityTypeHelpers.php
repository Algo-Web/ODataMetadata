<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;

use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;

/**
 * Trait EntityTypeHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IEntityTypeHelpers
{
    /**
     * Gets the base type of this entity type definition.
     *
     * @return IEntityType|null The base type of t221his entity type definition
     */
    public function BaseEntityType(): ?IEntityType;

    /**
     * Gets the navigation properties declared in this entity definition.
     *
     * @return INavigationProperty[] The navigation properties declared in this entity definition
     */
    public function DeclaredNavigationProperties(): array;

    /**
     * Get the navigation properties declared in this entity type and all base types.
     *
     * @return INavigationProperty[] the navigation properties declared in this entity type and all base types
     */
    public function NavigationProperties(): array;

    /**
     * Gets the declared key of the most defined entity with a declared key present.
     *
     * @return IStructuralProperty[]|null key of this type
     */
    public function Key(): ?array;

    /**
     * Checks whether the given entity type has the "property" as one of the key properties.
     *
     * @param  IProperty $property property to be searched for
     * @return bool      `true` if the type or base types has given property declared as key. `false` otherwise.
     */
    public function HasDeclaredKeyProperty(IProperty $property): bool;
}
