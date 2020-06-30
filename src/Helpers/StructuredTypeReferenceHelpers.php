<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;

/**
 * Trait StructuredTypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait StructuredTypeReferenceHelpers
{
    /**
     * Gets the definition of this structured type reference.
     *
     * @return IStructuredType|null the definition of this structured type reference
     */
    public function StructuredDefinition(): ?IStructuredType
    {
        $def = $this->getDefinition();
        return $def instanceof IStructuredType ? $def : null;
    }

    /**
     * Returns true if the definition of this reference is abstract.
     *
     * @return bool If the definition of this reference is abstract
     */
    public function IsAbstract(): bool
    {
        $def = $this->StructuredDefinition();
        return $def ? $def->isAbstract() : false;
    }

    /**
     * Returns true if the definition of this reference is open.
     *
     * @return bool If the definition of this reference is open
     */
    public function IsOpen(): bool
    {
        $def = $this->StructuredDefinition();
        return $def ? $def->isOpen() : false;
    }

    /**
     * Returns the base type of the definition of this reference.
     *
     * @return IStructuredType|null the base type of the definition of this reference
     */
    public function BaseType(): ?IStructuredType
    {
        $def = $this->StructuredDefinition();
        return $def ? $def->getBaseType() : null;
    }

    /**
     * Gets all structural properties declared in the definition of this reference.
     *
     * @return IStructuralProperty[] all structural properties declared in the definition of this reference
     */
    public function DeclaredStructuralProperties(): array
    {
        $def = $this->StructuredDefinition();
        return $def ? $def->DeclaredStructuralProperties() : [];
    }

    /**
     * Gets all structural properties declared in the definition of this reference and all its base types.
     *
     * @return IStructuralProperty[] all structural properties declared in the definition of this reference and all its base types
     */
    public function StructuralProperties(): array
    {
        $def = $this->StructuredDefinition();
        return $def ? $def->StructuralProperties() : [];
    }

    /**
     * Finds a property from the definition of this reference.
     *
     * @param  string         $name name of the property to find
     * @return IProperty|null The requested property if it exists. Otherwise, null.
     */
    public function FindProperty(string $name): ?IProperty
    {
        $def = $this->StructuredDefinition();
        return $def ? $def->findProperty($name) : null;
    }
}
