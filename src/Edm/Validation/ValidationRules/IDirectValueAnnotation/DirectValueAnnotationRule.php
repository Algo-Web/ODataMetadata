<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDirectValueAnnotation;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IDirectValueAnnotation;

abstract class DirectValueAnnotationRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IDirectValueAnnotation::class;
    }
}
