<?php


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\StructuredTypeHelpers;

/**
 * Interface IEdmStructuredType
 *
 * Common base interface for definitions of EDM structured types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 * @mixin StructuredTypeHelpers
 */
interface IStructuredType extends IType
{
    /**
     * @return bool Gets a value indicating whether this type is abstract.
     */
    public function isAbstract(): bool;

    /**
     * @return bool Gets a value indicating whether this type is open.
     */
    public function isOpen(): bool;

    /**
     * @return IStructuredType|null Gets the base type of this type.
     */
    public function getBaseType(): ?IStructuredType;

    /**
     * @return IProperty[] Gets the properties declared immediately within this type.
     */
    public function getDeclaredProperties(): array;

    /**
     * Searches for a structural or navigation property with the given name in this type and all base types and returns
     * null if no such property exists.
     *
     * @param string $name The name of the property being found.
     * @return IProperty|null The requested property, or null if no such property exists.
     */
    public function findProperty(string $name): ?IProperty;

}