<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IBinaryTypeReference;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that isUnbounded cannot be true if MaxLength is non-null.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IBinaryTypeReference
 */
class BinaryTypeReferenceBinaryUnboundedNotValidForMaxLength extends BinaryTypeReferenceRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $type)
    {
        assert($type instanceof IBinaryTypeReference);
        if (null !== $type->getMaxLength() && $type->isUnBounded()) {
            EdmUtil::checkArgumentNull($type->Location(), 'type->Location');
            $context->AddError(
                $type->Location(),
                EdmErrorCode::IsUnboundedCannotBeTrueWhileMaxLengthIsNotNull(),
                StringConst::EdmModel_Validator_Semantic_IsUnboundedCannotBeTrueWhileMaxLengthIsNotNull()
            );
        }
    }
}
