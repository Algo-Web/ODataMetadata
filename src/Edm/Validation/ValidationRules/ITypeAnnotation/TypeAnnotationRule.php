<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITypeAnnotation;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\ITypeAnnotation;

abstract class TypeAnnotationRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return ITypeAnnotation::class;
    }
}
