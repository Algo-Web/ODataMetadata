<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Interfaces\Annotations;

use AlgoWeb\ODataMetadata\Helpers\VocabularyAnnotationHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

/**
 * Interface IVocabularyAnnotation.
 * @package AlgoWeb\ODataMetadata\Interfaces\Annotations
 * @mixin VocabularyAnnotationHelpers
 */
interface IVocabularyAnnotation extends IEdmElement
{
    /**
     * @return string gets the qualifier used to discriminate between multiple bindings of the same property or type
     */
    public function getQualifier(): string;

    /**
     * @return ITerm gets the term bound by the annotation
     */
    public function getTerm(): ITerm;

    /**
     * @return IVocabularyAnnotatable gets the element the annotation applies to
     */
    public function getTarget(): IVocabularyAnnotatable;
}
