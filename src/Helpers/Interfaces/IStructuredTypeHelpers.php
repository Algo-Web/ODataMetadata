<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;

use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use Generator;

/**
 * Trait StructuredTypeDefinitionHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IStructuredTypeHelpers
{
    /**
     * Gets all properties of the structured type definition and its base types.
     *
     * @return Generator|IProperty[] properties of this type
     */
    public function properties(): iterable;

    /**
     * Gets all structural properties declared in the IStructuredTypeDefinition.
     *
     * @return IStructuralProperty[] all structural properties declared in the IStructuredTypeDefinition
     */
    public function declaredStructuralProperties();

    /**
     * Gets the structural properties declared in this type definition and all base types.
     *
     * @return IStructuralProperty[] the structural properties declared in this type definition and all base types
     */
    public function structuralProperties();

    public function inheritsFrom(IStructuredType $potentialBaseType);
}
