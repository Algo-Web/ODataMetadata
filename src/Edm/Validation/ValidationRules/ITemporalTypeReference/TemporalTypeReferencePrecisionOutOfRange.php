<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITemporalTypeReference;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that the precision is between 0 and the max precision of the temporal type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITemporalTypeReference
 */
class TemporalTypeReferencePrecisionOutOfRange extends TemporalTypeReferenceRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $type)
    {
        assert($type instanceof ITemporalTypeReference);
        if ($type->getPrecision() > EdmConstants::Max_Precision ||
            $type->getPrecision() < EdmConstants::Min_Precision) {
            EdmUtil::checkArgumentNull($type->location(), 'type->Location');
            $context->addError(
                $type->location(),
                EdmErrorCode::PrecisionOutOfRange(),
                StringConst::EdmModel_Validator_Semantic_PrecisionOutOfRange()
            );
        }
    }
}
