<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;

use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;

/**
 * Trait StructuredTypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IStructuredTypeReferenceHelpers
{
    /**
     * Gets the definition of this structured type reference.
     *
     * @return IStructuredType|null the definition of this structured type reference
     */
    public function structuredDefinition(): ?IStructuredType;

    /**
     * Returns true if the definition of this reference is abstract.
     *
     * @return bool If the definition of this reference is abstract
     */
    public function isAbstract(): bool;

    /**
     * Returns true if the definition of this reference is open.
     *
     * @return bool If the definition of this reference is open
     */
    public function isOpen(): bool;

    /**
     * Returns the base type of the definition of this reference.
     *
     * @return IStructuredType|null the base type of the definition of this reference
     */
    public function baseType(): ?IStructuredType;

    /**
     * Gets all structural properties declared in the definition of this reference.
     *
     * @return IStructuralProperty[] all structural properties declared in the definition of this reference
     */
    public function declaredStructuralProperties(): array;

    /**
     * Gets all structural properties declared in the definition of this reference and all its base types.
     *
     * @return IStructuralProperty[] all structural properties declared in the definition of this reference and all its base types
     */
    public function structuralProperties(): array;

    /**
     * Finds a property from the definition of this reference.
     *
     * @param  string         $name name of the property to find
     * @return IProperty|null The requested property if it exists. Otherwise, null.
     */
    public function findProperty(string $name): ?IProperty;
}
