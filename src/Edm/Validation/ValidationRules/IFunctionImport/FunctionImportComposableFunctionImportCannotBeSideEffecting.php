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
 * Validates that if a function is composable, it is not also side-effecting.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport
 */
class FunctionImportComposableFunctionImportCannotBeSideEffecting extends FunctionImportRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $functionImport)
    {
        assert($functionImport instanceof IFunctionImport);
        if ($functionImport->isComposable() && $functionImport->isSideEffecting()) {
            EdmUtil::checkArgumentNull($functionImport->location(), 'functionImport->Location');
            $context->addError(
                $functionImport->location(),
                EdmErrorCode::ComposableFunctionImportCannotBeSideEffecting(),
                StringConst::EdmModel_Validator_Semantic_ComposableFunctionImportCannotBeSideEffecting($functionImport->getName())
            );
        }
    }
}
