<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IValueTerm;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Value terms are not supported before EDM 3.0.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IValueTerm
 */
class ValueTermsNotSupportedBeforeV3 extends ValueTermsRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $valueTerm)
    {
        assert($valueTerm instanceof IValueTerm);
        $context->AddError(
            $valueTerm->Location(),
            EdmErrorCode::ValueTermsNotSupportedBeforeV3(),
            StringConst::EdmModel_Validator_Semantic_ValueTermsNotSupportedBeforeV3()
        );
    }

}