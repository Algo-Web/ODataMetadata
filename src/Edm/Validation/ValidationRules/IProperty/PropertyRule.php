<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;

/**
 * Class PropertyRule.
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IProperty
 */
abstract class PropertyRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IProperty::class;
    }
}
