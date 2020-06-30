<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEnumType;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;

abstract class EnumTypeRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IEnumType::class;
    }
}
