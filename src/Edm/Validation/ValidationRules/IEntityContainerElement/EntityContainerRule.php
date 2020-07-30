<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityContainerElement;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;

abstract class EntityContainerRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IEntityContainerElement::class;
    }
}
