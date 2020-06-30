<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IValueAnnotation;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IValueAnnotation;

abstract class ValueAnnotationRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IValueAnnotation::class;
    }
}
