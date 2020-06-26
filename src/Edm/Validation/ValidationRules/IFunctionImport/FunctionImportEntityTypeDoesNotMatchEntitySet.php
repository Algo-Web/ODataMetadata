<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that the return type of a function import must match the type of the entity set of the function.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport
 */
class FunctionImportEntityTypeDoesNotMatchEntitySet extends FunctionImportRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $functionImport)
    {
        assert($functionImport instanceof IFunctionImport);
        if ($functionImport->getEntitySet() != null && $functionImport->getReturnType() != null)
        {
            $elementType = $functionImport->getReturnType()->IsCollection() ?
                $functionImport->getReturnType()->AsCollection()->ElementType() :
                $functionImport->getReturnType();
            if ($elementType->IsEntity())
            {
                $returnedEntityType = $elementType->AsEntity()->EntityDefinition();

                /**
                 * @var IEntitySet $entitySet;
                 */
                $entitySet = null;
                /**
                 * @var IFunctionParameter $parameter
                 */
                $parameter = null;
                /**
                 * @var INavigationProperty[] $path
                 */
                $path = null;
                if ($functionImport->TryGetStaticEntitySet($entitySet))
                {
                    $errorMessage = StringConst::EdmModel_Validator_Semantic_FunctionImportEntityTypeDoesNotMatchEntitySet(
                        $functionImport->getName(),
                        $returnedEntityType->FullName(),
                        $entitySet->getName()
                    );

                    $entitySetElementType = $entitySet->getElementType();
                    if (
                        !$returnedEntityType->IsOrInheritsFrom($entitySetElementType) &&
                        !$context->checkIsBad($returnedEntityType) &&
                        !$context->checkIsBad($entitySet) &&
                        !$context->checkIsBad($entitySetElementType)
                    )
                    {
                        $context->AddError(
                            $functionImport->Location(),
                            EdmErrorCode::FunctionImportEntityTypeDoesNotMatchEntitySet(),
                            $errorMessage);
                    }
                }
                else if ($functionImport->TryGetRelativeEntitySetPath($context->getModel(), $parameter, $path))
                {
                    $relativePathType = count($path) == 0 ? $parameter->getType() : end($path)->getType();
                    $relativePathElementType = $relativePathType->IsCollection() ? $relativePathType->AsCollection()->ElementType() : $relativePathType;
                    if (
                        !$returnedEntityType->IsOrInheritsFrom($relativePathElementType->getDefinition()) &&
                        !$context->checkIsBad($returnedEntityType) && !$context->checkIsBad($relativePathElementType->getDefinition()))
                    {
                        $context->AddError(
                            $functionImport->Location(),
                            EdmErrorCode::FunctionImportEntityTypeDoesNotMatchEntitySet(),
                            StringConst::EdmModel_Validator_Semantic_FunctionImportEntityTypeDoesNotMatchEntitySet2($functionImport->getName(), $elementType->FullName()));
                    }
                }

                // The case when all try gets fail is caught by the FunctionImportEntitySetExpressionIsInvalid rule.
            }
            else if (!$context->checkIsBad($elementType->getDefinition()))
            {
                $context->AddError(
                    $functionImport->Location(),
                    EdmErrorCode::FunctionImportSpecifiesEntitySetButDoesNotReturnEntityType(),
                    StringConst::EdmModel_Validator_Semantic_FunctionImportSpecifiesEntitySetButNotEntityType($functionImport->getName()));
            }
        }
    }
}