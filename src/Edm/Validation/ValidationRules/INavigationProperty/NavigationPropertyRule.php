<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;

abstract class NavigationPropertyRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return INavigationProperty::class;
    }
}
