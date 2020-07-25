<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\IType;

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
    public function structuredDefinition(): ?IStructuredType
    {
        $def = $this->getDefinition();
        return $def instanceof IStructuredType ? $def : null;
    }

    /**
     * Returns true if the definition of this reference is abstract.
     *
     * @return bool If the definition of this reference is abstract
     */
    public function isAbstract(): bool
    {
        $def = $this->structuredDefinition();
        return $def ? $def->isAbstract() : false;
    }

    /**
     * Returns true if the definition of this reference is open.
     *
     * @return bool If the definition of this reference is open
     */
    public function isOpen(): bool
    {
        $def = $this->structuredDefinition();
        return $def ? $def->isOpen() : false;
    }

    /**
     * Returns the base type of the definition of this reference.
     *
     * @return IStructuredType|null the base type of the definition of this reference
     */
    public function baseType(): ?IStructuredType
    {
        $def = $this->structuredDefinition();
        return $def ? $def->getBaseType() : null;
    }

    /**
     * Gets all structural properties declared in the definition of this reference.
     *
     * @return IStructuralProperty[] all structural properties declared in the definition of this reference
     */
    public function declaredStructuralProperties(): array
    {
        $def = $this->structuredDefinition();
        return $def ? $def->declaredStructuralProperties() : [];
    }

    /**
     * Gets all structural properties declared in the definition of this reference and all its base types.
     *
     * @return IStructuralProperty[] all structural properties declared in the definition of this reference and
     *                               all its base types
     */
    public function structuralProperties(): array
    {
        $def = $this->structuredDefinition();
        return $def ? $def->structuralProperties() : [];
    }

    /**
     * Finds a property from the definition of this reference.
     *
     * @param  string         $name name of the property to find
     * @return IProperty|null The requested property if it exists. Otherwise, null.
     */
    public function findProperty(string $name): ?IProperty
    {
        $def = $this->structuredDefinition();
        return $def ? $def->findProperty($name) : null;
    }

    abstract public function getDefinition(): ?IType;
}
