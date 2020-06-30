<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IBinaryTypeReference;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;

abstract class BinaryTypeReferenceRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IBinaryTypeReference::class;
    }
}
