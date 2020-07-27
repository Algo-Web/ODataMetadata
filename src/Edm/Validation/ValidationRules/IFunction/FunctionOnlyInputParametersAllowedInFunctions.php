<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunction;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
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
        $parameters = $function->getParameters();
        $parameters = array_filter(
            $parameters,
            function (IFunctionParameter $parameter) {
                return !$parameter->getMode()->isIn();
            }
        );
        foreach ($parameters as $parameter) {
            assert($parameter instanceof IFunctionParameter);
            EdmUtil::checkArgumentNull($parameter->location(), 'parameter->Location');
            $context->addError(
                $parameter->location(),
                EdmErrorCode::OnlyInputParametersAllowedInFunctions(),
                StringConst::EdmModel_Validator_Semantic_OnlyInputParametersAllowedInFunctions($parameter->getName(), $function->getName())
            );
        }
    }
}
