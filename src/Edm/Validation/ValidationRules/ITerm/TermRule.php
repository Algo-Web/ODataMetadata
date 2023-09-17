<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITerm;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;

abstract class TermRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return ITerm::class;
    }
}
