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
        if (null !== $functionImport->getReturnType() && null === $functionImport->getEntitySet()) {
            $elementType = $functionImport->getReturnType()->isCollection() ?
                $functionImport->getReturnType()->asCollection()->ElementType()
                :
                $functionImport->getReturnType();
            if ($elementType->isEntity() && !$context->checkIsBad($elementType->getDefinition())) {
                EdmUtil::checkArgumentNull($functionImport->Location(), 'functionImport->Location');
                $context->addError(
                    $functionImport->Location(),
                    EdmErrorCode::FunctionImportReturnsEntitiesButDoesNotSpecifyEntitySet(),
                    StringConst::EdmModel_Validator_Semantic_FunctionImportReturnEntitiesButDoesNotSpecifyEntitySet($functionImport->getName())
                );
            }
        }
    }
}
