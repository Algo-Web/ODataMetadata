<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStringTypeReference;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that IsUnbounded cannot be true if MaxLength is non-null.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStringTypeReference
 */
class StringTypeReferenceStringUnboundedNotValidForMaxLength extends StringTypeReferenceRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $type)
    {
        assert($type instanceof IStringTypeReference);
        if (null !== $type->getMaxLength() && $type->isUnbounded()) {
            EdmUtil::checkArgumentNull($type->location(), 'type->Location');
            $context->addError(
                $type->location(),
                EdmErrorCode::IsUnboundedCannotBeTrueWhileMaxLengthIsNotNull(),
                StringConst::EdmModel_Validator_Semantic_IsUnboundedCannotBeTrueWhileMaxLengthIsNotNull()
            );
        }
    }
}
