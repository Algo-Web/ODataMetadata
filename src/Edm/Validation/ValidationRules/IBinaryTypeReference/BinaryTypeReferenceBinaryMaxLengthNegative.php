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
 * Validates that the max length of a binary type is not negative.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IBinaryTypeReference
 */
class BinaryTypeReferenceBinaryMaxLengthNegative extends BinaryTypeReferenceRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $type)
    {
        assert($type instanceof IBinaryTypeReference);
        if ($type->getMaxLength() < 0) {
            EdmUtil::checkArgumentNull($type->Location(), 'type->Location');
            $context->addError(
                $type->Location(),
                EdmErrorCode::MaxLengthOutOfRange(),
                StringConst::EdmModel_Validator_Semantic_MaxLengthOutOfRange()
            );
        }
    }
}
