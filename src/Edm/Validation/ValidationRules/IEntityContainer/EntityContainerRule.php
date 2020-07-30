<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityContainer;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;

abstract class EntityContainerRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IEntityContainer::class;
    }
}
