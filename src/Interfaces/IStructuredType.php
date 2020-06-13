<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\StructuredTypeHelpers;

/**
 * Interface IEdmStructuredType.
 *
 * Common base interface for definitions of EDM structured types.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 * @mixin StructuredTypeHelpers
 */
interface IStructuredType extends IType
{
    /**
     * @return bool gets a value indicating whether this type is abstract
     */
    public function isAbstract(): bool;

    /**
     * @return bool gets a value indicating whether this type is open
     */
    public function isOpen(): bool;

    /**
     * @return IStructuredType|null gets the base type of this type
     */
    public function getBaseType(): ?IStructuredType;

    /**
     * @return IProperty[] gets the properties declared immediately within this type
     */
    public function getDeclaredProperties(): array;

    /**
     * Searches for a structural or navigation property with the given name in this type and all base types and returns
     * null if no such property exists.
     *
     * @param  string         $name the name of the property being found
     * @return IProperty|null the requested property, or null if no such property exists
     */
    public function findProperty(string $name): ?IProperty;
}
