<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that a function import is not composable.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport
 */
class FunctionImportIsComposableNotSupportedBeforeV3 extends FunctionImportRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $functionImport)
    {
        assert($functionImport instanceof IFunctionImport);
        if ($functionImport->isComposable() != CsdlConstants::Default_IsComposable) {
            EdmUtil::checkArgumentNull($functionImport->location(), 'functionImport->Location');
            $context->addError(
                $functionImport->location(),
                EdmErrorCode::FunctionImportComposableNotSupportedBeforeV3(),
                StringConst::EdmModel_Validator_Semantic_FunctionImportComposableNotSupportedBeforeV3()
            );
        }
    }
}
