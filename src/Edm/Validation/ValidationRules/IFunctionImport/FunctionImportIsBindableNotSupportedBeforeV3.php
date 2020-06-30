<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that a function is not bindable.
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport
 */
class FunctionImportIsBindableNotSupportedBeforeV3 extends FunctionImportRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $functionImport)
    {
        assert($functionImport instanceof  IFunctionImport);
        if ($functionImport->isBindable() != CsdlConstants::Default_IsBindable) {
            $context->AddError(
                $functionImport->Location(),
                EdmErrorCode::FunctionImportBindableNotSupportedBeforeV3(),
                StringConst::EdmModel_Validator_Semantic_FunctionImportBindableNotSupportedBeforeV3()
            );
        }
    }
}
