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
 * Validates that a function import has an allowed return type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport
 */
class FunctionImportUnsupportedReturnTypeAfterV1 extends FunctionImportRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $functionImport)
    {
        assert($functionImport instanceof IFunctionImport);
        if (null !== $functionImport->getReturnType()) {
            $elementType = $functionImport->getReturnType()->isCollection() ?
                $functionImport->getReturnType()->asCollection()->elementType() :
                $functionImport->getReturnType();
            if (!$elementType->isPrimitive() &&
                !$elementType->isEntity() &&
                !$elementType->isComplex() &&
                !$elementType->isEnum() &&
                !$context->checkIsBad($elementType->getDefinition())
            ) {
                EdmUtil::checkArgumentNull($functionImport->location(), 'functionImport->Location');
                $context->addError(
                    $functionImport->location(),
                    EdmErrorCode::FunctionImportUnsupportedReturnType(),
                    StringConst::EdmModel_Validator_Semantic_FunctionImportWithUnsupportedReturnTypeAfterV1(
                        $functionImport->getName()
                    )
                );
            }
        }
    }
}
