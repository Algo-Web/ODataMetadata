<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces\Annotations;

use AlgoWeb\ODataMetadata\Helpers\Interfaces\IVocabularyAnnotationHelpers;
use AlgoWeb\ODataMetadata\Helpers\VocabularyAnnotationHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

/**
 * Interface IVocabularyAnnotation.
 * @package AlgoWeb\ODataMetadata\Interfaces\Annotations
 */
interface IVocabularyAnnotation extends IEdmElement, IVocabularyAnnotationHelpers
{
    /**
     * @return string|null gets the qualifier used to discriminate between multiple bindings of the same property/type
     */
    public function getQualifier(): ?string;

    /**
     * @return ITerm|null gets the term bound by the annotation
     */
    public function getTerm(): ?ITerm;

    /**
     * @return IVocabularyAnnotatable|null gets the element the annotation applies to
     */
    public function getTarget(): ?IVocabularyAnnotatable;
}
