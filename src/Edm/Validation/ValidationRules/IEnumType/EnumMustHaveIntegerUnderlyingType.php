<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEnumType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Raises an error if the underlying type of an enum type is not an integer type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEnumType
 */
class EnumMustHaveIntegerUnderlyingType extends EnumTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $enumType)
    {
        assert($enumType instanceof IEnumType);
        if (!$enumType->getUnderlyingType()->getPrimitiveKind()->isIntegral() && !$context->checkIsBad($enumType->getUnderlyingType())) {
            $context->AddError(
                $enumType->Location(),
                EdmErrorCode::EnumMustHaveIntegerUnderlyingType(),
                StringConst::EdmModel_Validator_Semantic_EnumMustHaveIntegralUnderlyingType($enumType->FullName())
            );
        }
    }
}
