<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPropertyValueBinding;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IPropertyValueBinding;

abstract class PropertyValueBindingRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IPropertyValueBinding::class;
    }
}
