<?php


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

/**
 * Trait VocabularyAnnotatableHelpers
 * @package AlgoWeb\ODataMetadata\Helpers
 * @mixin IVocabularyAnnotatable
 */
trait VocabularyAnnotatableHelpers
{
    /**
     * Gets an annotatable element's vocabulary annotations as seen from a particular model.
     *
     * @param IModel $model Model to check for annotations.
     * @return IVocabularyAnnotation[] Annotations attached to the element by the model or by models referenced by the model.
     */
    public function VocabularyAnnotations(IModel $model): array
    {
        return $model->findVocabularyAnnotations($this);
    }
}