<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IComplexType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that a complex type does not inherit.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IComplexType
 */
class ComplexTypeInvalidPolymorphicComplexType extends ComplexTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $edmComplexType)
    {
        assert($edmComplexType instanceof IComplexType);
        if ($edmComplexType->getBaseType() != null) {
            $context->AddError(
                $edmComplexType->Location(),
                EdmErrorCode::InvalidPolymorphicComplexType(),
                StringConst::EdmModel_Validator_Semantic_InvalidComplexTypePolymorphic($edmComplexType->FullName())
            );
        }
    }
}
