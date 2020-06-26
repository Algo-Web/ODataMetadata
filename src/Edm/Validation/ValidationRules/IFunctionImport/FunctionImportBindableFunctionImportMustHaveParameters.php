<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that if a function is bindable, it must have parameters.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport
 */
class FunctionImportBindableFunctionImportMustHaveParameters extends FunctionImportRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $functionImport)
    {
        assert($functionImport instanceof IFunctionImport);
        if ($functionImport->isBindable() && count($functionImport->getParameters()) === 0)
        {
            $context->AddError(
                $functionImport->Location(),
                EdmErrorCode::BindableFunctionImportMustHaveParameters(),
                StringConst::EdmModel_Validator_Semantic_BindableFunctionImportMustHaveParameters($functionImport->getName())
            );
        }
    }
}