<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\IType;

/**
 * Class EntityTypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait EntityTypeReferenceHelpers
{
    /**
     * Gets the definition of this entity reference.
     *
     * @return IEntityType the definition of this entity reference
     */
    public function EntityDefinition(): IEntityType
    {
        /**
         * @var $this IEntityTypeReference
         */
        $def = $this->getDefinition();
        assert($def instanceof IEntityType);
        return $def;
    }

    /**
     * Gets the base type of the definition of this reference.
     *
     * @return IEntityType|null the base type of the definition of this reference
     */
    public function BaseEntityType(): ?IEntityType
    {
        /*
         * @var $this IEntityTypeReference
         */
        return $this->EntityDefinition()->BaseEntityType();
    }

    /**
     * Gets the entity key of the definition of this reference.
     *
     * @return IStructuralProperty[] the entity key of the definition of this reference
     */
    public function Key(): array
    {
        return $this->EntityDefinition()->Key();
    }

    /**
     * Gets the navigation properties declared in the definition of this reference and its base types.
     *
     * @return INavigationProperty[] The navigation properties declared in the definition of this reference and its base types
     */
    public function NavigationProperties(): array
    {
        return $this->EntityDefinition()->NavigationProperties();
    }

    /**
     * Gets the navigation properties declared in the definition of this reference.
     *
     * @return INavigationProperty[] the navigation properties declared in the definition of this reference
     */
    public function DeclaredNavigationProperties(): array
    {
        return $this->EntityDefinition()->DeclaredNavigationProperties();
    }

    /**
     * Finds a navigation property declared in the definition of this reference by name.
     *
     * @param  string                   $name name of the navigation property to find
     * @return INavigationProperty|null The requested navigation property if it exists. Otherwise, null.
     */
    public function FindNavigationProperty(string $name): ?INavigationProperty
    {
        $prop = $this->EntityDefinition()->findProperty($name);
        return $prop instanceof INavigationProperty ? $prop : null;
    }

    abstract public function getDefinition(): ?IType;
}
