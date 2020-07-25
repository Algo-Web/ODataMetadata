<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
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
        if (null !== $functionImport->getReturnType()) {
            if ($functionImport->getReturnType()->isCollection()) {
                $elementType = $functionImport->getReturnType()->asCollection()->ElementType();
                $reportError = !$elementType->isPrimitive() && !$elementType->isEntity() && !$context->checkIsBad($elementType->getDefinition());
            } else {
                $reportError = true;
            }

            if ($reportError && !$context->checkIsBad($functionImport->getReturnType()->getDefinition())) {
                EdmUtil::checkArgumentNull($functionImport->Location(), 'functionImport->Location');
                $context->AddError(
                    $functionImport->Location(),
                    EdmErrorCode::FunctionImportUnsupportedReturnType(),
                    StringConst::EdmModel_Validator_Semantic_FunctionImportWithUnsupportedReturnTypeV1($functionImport->getName())
                );
            }
        }
    }
}
