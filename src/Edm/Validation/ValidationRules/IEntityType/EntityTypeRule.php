<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityType;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;

abstract class EntityTypeRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IEntityType::class;
    }
}
