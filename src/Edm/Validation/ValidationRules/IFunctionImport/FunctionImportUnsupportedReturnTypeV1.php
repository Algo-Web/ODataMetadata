<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that a function import has an allowed return type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport
 */
class FunctionImportUnsupportedReturnTypeV1 extends FunctionImportRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $functionImport)
    {
        assert($functionImport instanceof IFunctionImport);
        if ($functionImport->getReturnType() != null) {
            if ($functionImport->getReturnType()->IsCollection()) {
                $elementType = $functionImport->getReturnType()->AsCollection()->ElementType();
                $reportError = !$elementType->IsPrimitive() && !$elementType->IsEntity() && !$context->checkIsBad($elementType->getDefinition());
            } else {
                $reportError = true;
            }

            if ($reportError && !$context->checkIsBad($functionImport->getReturnType()->getDefinition())) {
                $context->AddError(
                    $functionImport->Location(),
                    EdmErrorCode::FunctionImportUnsupportedReturnType(),
                    StringConst::EdmModel_Validator_Semantic_FunctionImportWithUnsupportedReturnTypeV1($functionImport->getName())
                );
            }
        }
    }
}
