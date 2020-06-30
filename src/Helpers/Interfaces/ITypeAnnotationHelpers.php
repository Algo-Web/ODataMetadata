<?php

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;


use AlgoWeb\ODataMetadata\Interfaces\Annotations\IPropertyValueBinding;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;

/**
 * Trait TypeAnnotationHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface ITypeAnnotationHelpers
{
    /**
     * Gets the binding of a property of the type term of a type annotation.
     *
     * @param IProperty|string $property property (Or Property Name) to search for
     * @return IPropertyValueBinding|null the binding of the property in the type annotation, or null if no binding exists
     */
    public function FindPropertyBinding($property): ?IPropertyValueBinding;
}