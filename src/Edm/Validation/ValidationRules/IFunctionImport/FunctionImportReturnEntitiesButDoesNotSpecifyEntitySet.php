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
 * Validates that if a function import specifies an entity or collection of entities as its return type, it must also
 * specify an entity set.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport
 */
class FunctionImportReturnEntitiesButDoesNotSpecifyEntitySet extends FunctionImportRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $functionImport)
    {
        assert($functionImport instanceof IFunctionImport);
        if ($functionImport->getReturnType() != null && $functionImport->getEntitySet() == null) {
            $elementType = $functionImport->getReturnType()->IsCollection() ?
                $functionImport->getReturnType()->AsCollection()->ElementType()
                :
                $functionImport->getReturnType();
            if ($elementType->IsEntity() && !$context->checkIsBad($elementType->getDefinition())) {
                EdmUtil::checkArgumentNull($functionImport->Location(), 'functionImport->Location');
                $context->AddError(
                    $functionImport->Location(),
                    EdmErrorCode::FunctionImportReturnsEntitiesButDoesNotSpecifyEntitySet(),
                    StringConst::EdmModel_Validator_Semantic_FunctionImportReturnEntitiesButDoesNotSpecifyEntitySet($functionImport->getName())
                );
            }
        }
    }
}
