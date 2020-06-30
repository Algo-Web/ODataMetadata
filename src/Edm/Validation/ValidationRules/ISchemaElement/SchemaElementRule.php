<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ISchemaElement;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;

abstract class SchemaElementRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return ISchemaElement::class;
    }
}
