<?php


namespace AlgoWeb\ODataMetadata\Interfaces\Annotations;

use AlgoWeb\ODataMetadata\Helpers\VocabularyAnnotationHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

/**
 * Interface IVocabularyAnnotation
 * @package AlgoWeb\ODataMetadata\Interfaces\Annotations
 * @mixin VocabularyAnnotationHelpers
 */
interface IVocabularyAnnotation extends IEdmElement
{
    /**
     * @return string Gets the qualifier used to discriminate between multiple bindings of the same property or type.
     */
    public function getQualifier(): string;

    /**
     * @return ITerm Gets the term bound by the annotation.
     */
    public function getTerm(): ITerm;

    /**
     * @return IVocabularyAnnotatable Gets the element the annotation applies to.
     */
    public function getTarget(): IVocabularyAnnotatable;

}