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
 * Validates that a complex type is not abstract.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IComplexType
 */
class ComplexTypeInvalidAbstractComplexType extends ComplexTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $complexType)
    {
        assert($complexType instanceof IComplexType);
        if ($complexType->isAbstract()) {
            EdmUtil::checkArgumentNull($complexType->Location(), 'complexType->Location');
            $context->AddError(
                $complexType->Location(),
                EdmErrorCode::InvalidAbstractComplexType(),
                StringConst::EdmModel_Validator_Semantic_InvalidComplexTypeAbstract($complexType->FullName())
            );
        }
    }
}
