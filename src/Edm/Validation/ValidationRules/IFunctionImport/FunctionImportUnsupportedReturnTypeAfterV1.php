<?php


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
class FunctionImportUnsupportedReturnTypeAfterV1 extends FunctionImportRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $functionImport)
    {
        assert($functionImport instanceof IFunctionImport);
        if ($functionImport->getReturnType() != null)
        {
            $elementType = $functionImport->getReturnType()->IsCollection() ?
                $functionImport->getReturnType()->AsCollection()->ElementType() :
                $functionImport->getReturnType();
            if (
                !$elementType->IsPrimitive() &&
                !$elementType->IsEntity() &&
                !$elementType->IsComplex() &&
                !$elementType->IsEnum() &&
                !$context->checkIsBad($elementType->getDefinition())
            )
            {
                $context->AddError(
                    $functionImport->Location(),
                    EdmErrorCode::FunctionImportUnsupportedReturnType(),
                    StringConst::EdmModel_Validator_Semantic_FunctionImportWithUnsupportedReturnTypeAfterV1(
                        $functionImport->getName()
                    )
                );
            }
        }
    }
}