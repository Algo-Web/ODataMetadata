<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;

/**
 * Trait EntityTypeHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait EntityTypeHelpers
{
    /**
     * Gets the base type of this entity type definition.
     *
     * @return IEntityType|null The base type of this entity type definition
     */
    public function BaseEntityType(): ?IEntityType
    {
        /**
         * @var IEntityType $self
         */
        $self = $this;
        $base = $self->getBaseType();
        return $base instanceof IEntityType ? $base : null;
    }

    /**
     * Gets the navigation properties declared in this entity definition.
     *
     * @return INavigationProperty[] The navigation properties declared in this entity definition
     */
    public function DeclaredNavigationProperties(): array
    {
        /**
         * @var IEntityType $self
         */
        $self = $this;
        return array_filter($self->getDeclaredProperties(), function (IProperty $value) {
            return $value instanceof INavigationProperty;
        });
    }

    /**
     * Get the navigation properties declared in this entity type and all base types.
     *
     * @return INavigationProperty[] the navigation properties declared in this entity type and all base types
     */
    public function NavigationProperties(): array
    {
        /**
         * @var IEntityType $self
         */
        $self  = $this;
        $props = iterator_to_array($self->Properties());
        return array_filter($props, function (IProperty $value) {
            return $value instanceof INavigationProperty;
        });
    }

    /**
     * Gets the declared key of the most defined entity with a declared key present.
     *
     * @return IStructuralProperty[] key of this type
     */
    public function Key(): array
    {
        /**
         * @var IEntityType $checkingType
         */
        $checkingType = $this;
        while ($checkingType !== null) {
            if ($checkingType->getDeclaredKey() !== null) {
                return $checkingType->getDeclaredKey();
            }
            $checkingType = $checkingType->BaseEntityType();
        }
        return [];
    }

    /**
     * Checks whether the given entity type has the "property" as one of the key properties.
     *
     * @param  IProperty $property property to be searched for
     * @return bool      `true` if the type or base types has given property declared as key. `false` otherwise.
     */
    public function HasDeclaredKeyProperty(IProperty $property): bool
    {
        /**
         * @var IEntityType $entityType
         */
        $entityType = $this;
        while ($entityType !== null) {
            if ($entityType->getDeclaredKey() !== null && in_array($property, $entityType->getDeclaredKey())) {
                return true;
            }

            $entityType = $entityType->BaseEntityType();
        }
        return false;
    }
}
