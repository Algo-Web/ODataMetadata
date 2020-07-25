<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDecimalTypeReference;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that the precision is between 0 and the max precision of the decimal type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDecimalTypeReference
 */
class DecimalTypeReferencePrecisionOutOfRange extends DecimalTypeReferenceRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $type)
    {
        assert($type instanceof IDecimalTypeReference);
        if ($type->getPrecision() > EdmConstants::Max_Precision ||
            $type->getPrecision() < EdmConstants::Min_Precision) {
            EdmUtil::checkArgumentNull($type->Location(), 'type->Location');
            $context->addError(
                $type->Location(),
                EdmErrorCode::PrecisionOutOfRange(),
                StringConst::EdmModel_Validator_Semantic_PrecisionOutOfRange()
            );
        }
    }
}
