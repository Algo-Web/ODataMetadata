<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IVocabularyAnnotation;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;

abstract class VocabularyAnnotationRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IVocabularyAnnotation::class;
    }
}
