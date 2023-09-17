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
 *  Validates that a function import is not side-effecting.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport
 */
class FunctionImportIsSideEffectingNotSupportedBeforeV3 extends FunctionImportRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $functionImport)
    {
        assert($functionImport instanceof IFunctionImport);
        if ($functionImport->isSideEffecting() != CsdlConstants::Default_IsSideEffecting) {
            EdmUtil::checkArgumentNull($functionImport->location(), 'functionImport->Location');
            $context->addError(
                $functionImport->location(),
                EdmErrorCode::FunctionImportSideEffectingNotSupportedBeforeV3(),
                StringConst::EdmModel_Validator_Semantic_FunctionImportSideEffectingNotSupportedBeforeV3()
            );
        }
    }
}
