<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunction;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that no function parameters are output parameters.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunction
 */
class FunctionOnlyInputParametersAllowedInFunctions extends FunctionRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $function)
    {
        assert($function instanceof IFunction);
        foreach ($function->getParameters() as $parameter) {
            assert($parameter instanceof IFunctionParameter);
            if (!$parameter->getMode()->isIn()) {
                $context->AddError(
                    $parameter->Location(),
                    EdmErrorCode::OnlyInputParametersAllowedInFunctions(),
                    StringConst::EdmModel_Validator_Semantic_OnlyInputParametersAllowedInFunctions($parameter->getName(), $function->getName())
                );
            }
        }
    }
}
