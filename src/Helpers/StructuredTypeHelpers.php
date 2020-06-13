<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use Generator;

/**
 * Trait StructuredTypeDefinitionHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 * @mixin IStructuredType
 */
trait StructuredTypeHelpers
{
    /**
     * Gets all properties of the structured type definition and its base types.
     *
     * @return Generator properties of this type
     */
    public function Properties(): Generator
    {
        if ($this->getBaseType() !== null) {
            foreach ($this->getBaseType()->Properties() as $baseProperty) {
                yield $baseProperty;
            }
        }
        foreach ($this->getDeclaredProperties() as $declaredProperty) {
            yield $declaredProperty;
        }
    }

    /**
     * Gets all structural properties declared in the IStructuredTypeDefinition.
     *
     * @return IStructuralProperty[] all structural properties declared in the IStructuredTypeDefinition
     */
    public function DeclaredStructuralProperties()
    {
        return array_filter($this->getDeclaredProperties(), function (IProperty $value) {
            return $value instanceof IStructuralProperty;
        });
    }

    /**
     * Gets the structural properties declared in this type definition and all base types.
     *
     * @return IStructuralProperty[] the structural properties declared in this type definition and all base types
     */
    public function StructuralProperties()
    {
        $props = iterator_to_array($this->Properties());
        return array_filter($props, function (IProperty $value) {
            return $value instanceof IStructuralProperty;
        });
    }

    public function InheritsFrom(IStructuredType $potentialBaseType)
    {
        $type = $this;
        do {
            $type = $type->getBaseType();
            if ($type === $potentialBaseType) {
                return true;
            }
        } while ($type !== null);
        return false;
    }
}
