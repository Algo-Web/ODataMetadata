<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IVocabularyAnnotatable;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;

abstract class VocabularyAnnotatableRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IVocabularyAnnotatable::class;
    }
}
