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
 * Validates that the type of a function imports parameter is correct.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport
 */
class FunctionImportParametersIncorrectTypeBeforeV3 extends FunctionImportRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $functionImport)
    {
        assert($functionImport instanceof IFunctionImport);
        foreach ($functionImport->getParameters() as $functionParameter) {
            $type = $functionParameter->getType();
            if (!$type->isPrimitive() && !$type->isComplex() && !$context->checkIsBad($type->getDefinition())
            ) {
                EdmUtil::checkArgumentNull($functionImport->Location(), 'functionImport->Location');
                $context->AddError(
                    $functionParameter->Location(),
                    EdmErrorCode::FunctionImportParameterIncorrectType(),
                    StringConst::EdmModel_Validator_Semantic_FunctionImportParameterIncorrectType(
                        $type->fullName(),
                        $functionParameter->getName()
                    )
                );
            }
        }
    }
}
