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
 * Validates that the max length of a string is not negative.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStringTypeReference
 */
class StringTypeReferenceStringMaxLengthNegative extends StringTypeReferenceRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $type)
    {
        assert($type instanceof IStringTypeReference);
        if ($type->getMaxLength() < 0) {
            EdmUtil::checkArgumentNull($type->Location(), 'type->Location');
            $context->AddError(
                $type->Location(),
                EdmErrorCode::MaxLengthOutOfRange(),
                StringConst::EdmModel_Validator_Semantic_StringMaxLengthOutOfRange()
            );
        }
    }
}
