<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that no function import parameters have mode of none.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport
 */
class FunctionImportParametersCannotHaveModeOfNone extends FunctionImportRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $function)
    {
        assert($function instanceof IFunctionImport);
        foreach ($function->getParameters() as $parameter)
        {
            if ($parameter->getMode()->isNone() && !$context->checkIsBad($function))
            {
                $context->AddError(
                    $parameter->Location(),
                    EdmErrorCode::InvalidFunctionImportParameterMode(),
                    StringConst::EdmModel_Validator_Semantic_InvalidFunctionImportParameterMode(
                        $parameter->getName(), $function->getName())
                );
            }
        }
    }
}