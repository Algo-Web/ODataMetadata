<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;

/**
 * Trait VocabularyAnnotatableHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait VocabularyAnnotatableHelpers
{
    /**
     * Gets an annotatable element's vocabulary annotations as seen from a particular model.
     *
     * @param  IModel                  $model model to check for annotations
     * @return IVocabularyAnnotation[] annotations attached to the element by the model or by models referenced
     *                                 by the model
     */
    public function VocabularyAnnotations(IModel $model): array
    {
        return $model->findVocabularyAnnotations($this);
    }
}
