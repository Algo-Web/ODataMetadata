<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;

abstract class FunctionImportRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IFunctionImport::class;
    }
}
