<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Annotations;

/**
 * Class IEdmTypeAnnotation
 *
 * Represents an EDM type annotation.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Annotations
 */
interface ITypeAnnotation extends IVocabularyAnnotation
{
    /**
     * @return IPropertyValueBinding[] Gets the value annotations for the properties of the type.
     */
    public function getPropertyValueBindings(): array;
}