<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
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
        $parameters = $function->getParameters();
        $parameters = !$parameters ? [] : array_filter(
            $parameters,
            function (IFunctionParameter $parameter) {
                return $parameter->getMode()->isNone();
            }
        );
        foreach ($parameters as $parameter) {
            if (!$context->checkIsBad($function)) {
                EdmUtil::checkArgumentNull($parameter->location(), 'parameter->Location');
                $context->addError(
                    $parameter->location(),
                    EdmErrorCode::InvalidFunctionImportParameterMode(),
                    StringConst::EdmModel_Validator_Semantic_InvalidFunctionImportParameterMode(
                        $parameter->getName(),
                        $function->getName()
                    )
                );
            }
        }
    }
}
