<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\Helpers;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;

/**
 * Validates that the base type of a structured type can be found from the model being validated.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuredType
 */
class StructuredTypeInaccessibleBaseType extends StructuredTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $structuredType)
    {
        assert($structuredType instanceof IStructuredType);
        if ($structuredType instanceof ISchemaType && !$context->checkIsBad($structuredType)) {
            Helpers::CheckForUnreachableTypeError($context, $structuredType, $structuredType->Location());
        }
    }
}
