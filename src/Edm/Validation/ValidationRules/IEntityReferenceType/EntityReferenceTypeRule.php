<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntityReferenceType;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;

abstract class EntityReferenceTypeRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IEntityReferenceType::class;
    }
}
