<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDecimalTypeReference;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that the scale is between 0 and the precision of the decimal type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IDecimalTypeReference
 */
class DecimalTypeReferenceScaleOutOfRange extends DecimalTypeReferenceRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $type)
    {
        assert($type instanceof IDecimalTypeReference);
        if ($type->getScale() > $type->getPrecision() || $type->getScale() < 0) {
            EdmUtil::checkArgumentNull($type->location(), 'type->Location');
            $context->addError(
                $type->location(),
                EdmErrorCode::ScaleOutOfRange(),
                StringConst::EdmModel_Validator_Semantic_ScaleOutOfRange()
            );
        }
    }
}
