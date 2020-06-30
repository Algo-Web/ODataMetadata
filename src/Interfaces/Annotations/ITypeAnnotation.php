<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces\Annotations;

use AlgoWeb\ODataMetadata\Helpers\Interfaces\ITypeAnnotationHelpers;
use AlgoWeb\ODataMetadata\Helpers\TypeAnnotationHelpers;

/**
 * Class IEdmTypeAnnotation.
 *
 * Represents an EDM type annotation.
 *
 * @package AlgoWeb\ODataMetadata\Interfaces\Annotations
 */
interface ITypeAnnotation extends IVocabularyAnnotation, ITypeAnnotationHelpers
{
    /**
     * @return IPropertyValueBinding[] gets the value annotations for the properties of the type
     */
    public function getPropertyValueBindings(): array;
}
