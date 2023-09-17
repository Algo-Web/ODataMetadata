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
    public function entityDefinition(): IEntityType
    {
        /** @var $this IEntityTypeReference */
        $def = $this->getDefinition();
        assert($def instanceof IEntityType);
        return $def;
    }

    /**
     * Gets the base type of the definition of this reference.
     *
     * @return IEntityType|null the base type of the definition of this reference
     */
    public function baseEntityType(): ?IEntityType
    {
        /** @var $this IEntityTypeReference */
        return $this->entityDefinition()->baseEntityType();
    }

    /**
     * Gets the entity key of the definition of this reference.
     *
     * @return IStructuralProperty[] the entity key of the definition of this reference
     */
    public function key(): array
    {
        return $this->entityDefinition()->key() ?? [];
    }

    /**
     * Gets the navigation properties declared in the definition of this reference and its base types.
     *
     * @return INavigationProperty[] The navigation properties declared in the definition of this reference and its base types
     */
    public function navigationProperties(): array
    {
        return $this->entityDefinition()->navigationProperties();
    }

    /**
     * Gets the navigation properties declared in the definition of this reference.
     *
     * @return INavigationProperty[] the navigation properties declared in the definition of this reference
     */
    public function declaredNavigationProperties(): array
    {
        return $this->entityDefinition()->declaredNavigationProperties();
    }

    /**
     * Finds a navigation property declared in the definition of this reference by name.
     *
     * @param  string                   $name name of the navigation property to find
     * @return INavigationProperty|null The requested navigation property if it exists. Otherwise, null.
     */
    public function findNavigationProperty(string $name): ?INavigationProperty
    {
        $prop = $this->entityDefinition()->findProperty($name);
        return $prop instanceof INavigationProperty ? $prop : null;
    }

    abstract public function getDefinition(): ?IType;
}
