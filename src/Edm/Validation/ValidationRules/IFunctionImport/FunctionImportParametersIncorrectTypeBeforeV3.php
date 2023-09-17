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
 * Validates that the type of a function imports parameter is correct.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport
 */
class FunctionImportParametersIncorrectTypeBeforeV3 extends FunctionImportRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $functionImport)
    {
        assert($functionImport instanceof IFunctionImport);
        $parameters = $functionImport->getParameters();
        $parameters = !$parameters ? [] : array_filter(
            $parameters,
            function (IFunctionParameter $parameter) use ($context) {
                $type = $parameter->getType();
                $def  = $type->getDefinition();
                return !$type->isPrimitive() && !$type->isComplex() && (null !== $def) && !$context->checkIsBad($def);
            }
        );
        foreach ($parameters as $functionParameter) {
            $type = $functionParameter->getType();
            EdmUtil::checkArgumentNull($functionImport->location(), 'functionImport->Location');
            $context->addError(
                $functionParameter->location(),
                EdmErrorCode::FunctionImportParameterIncorrectType(),
                StringConst::EdmModel_Validator_Semantic_FunctionImportParameterIncorrectType(
                    $type->fullName(),
                    $functionParameter->getName()
                )
            );
        }
    }
}
