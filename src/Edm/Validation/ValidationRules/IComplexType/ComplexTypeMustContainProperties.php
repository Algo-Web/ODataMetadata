<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IComplexType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that a complex type contains at least one property.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IComplexType
 */
class ComplexTypeMustContainProperties extends ComplexTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $complexType)
    {
        assert($complexType instanceof IComplexType);
        if (!(count($complexType->properties()) == 0)) {
            EdmUtil::checkArgumentNull($complexType->location(), 'complexType->Location');
            $context->addError(
                $complexType->location(),
                EdmErrorCode::ComplexTypeMustHaveProperties(),
                StringConst::EdmModel_Validator_Semantic_ComplexTypeMustHaveProperties($complexType->fullName())
            );
        }
    }
}
