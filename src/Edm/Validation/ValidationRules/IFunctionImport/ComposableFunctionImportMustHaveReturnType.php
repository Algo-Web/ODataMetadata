<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that if a function import is composable, it must have a return type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport
 */
class ComposableFunctionImportMustHaveReturnType extends FunctionImportRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $functionImport)
    {
        assert($functionImport instanceof IFunctionImport);
        if ($functionImport->IsComposable() && $functionImport->getReturnType() == null) {
            $context->AddError(
                $functionImport->Location(),
                EdmErrorCode::ComposableFunctionImportMustHaveReturnType(),
                StringConst::EdmModel_Validator_Semantic_ComposableFunctionImportMustHaveReturnType($functionImport->getName())
            );
        }
    }
}
