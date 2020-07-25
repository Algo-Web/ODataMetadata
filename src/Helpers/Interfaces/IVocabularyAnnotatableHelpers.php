<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers\Interfaces;

use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;

/**
 * Trait VocabularyAnnotatableHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
interface IVocabularyAnnotatableHelpers
{
    /**
     * Gets an annotatable element's vocabulary annotations as seen from a particular model.
     *
     * @param  IModel                  $model model to check for annotations
     * @return IVocabularyAnnotation[] annotations attached to the element by the model or by models referenced by the model
     */
    public function vocabularyAnnotations(IModel $model): array;
}
