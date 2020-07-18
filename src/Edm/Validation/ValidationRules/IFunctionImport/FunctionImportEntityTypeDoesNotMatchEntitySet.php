<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
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
        EdmUtil::checkArgumentNull($functionImport->Location(), 'functionImport->Location');

        $returnType = $functionImport->getReturnType();
        if (null !== $functionImport->getEntitySet() && null !== $returnType) {
            /** @var ITypeReference $elementType */
            $elementType = $returnType->IsCollection() ?
                $returnType->AsCollection()->ElementType() :
                $returnType;
            EdmUtil::checkArgumentNull($elementType->getDefinition(), 'elementType->getDefinition');
            if ($elementType->IsEntity()) {
                $returnedEntityType = $elementType->AsEntity()->EntityDefinition();

                /** @var IEntitySet $entitySet */
                $entitySet = null;
                /** @var IFunctionParameter $parameter */
                $parameter = null;
                /** @var INavigationProperty[]|null $path */
                $path = null;
                if ($functionImport->TryGetStaticEntitySet($entitySet)) {
                    $entitySetElementType = $entitySet->getElementType();
                    $isBad = $returnedEntityType->IsOrInheritsFrom($entitySetElementType) ||
                             $context->checkIsBad($returnedEntityType) ||
                             $context->checkIsBad($entitySet) ||
                             $context->checkIsBad($entitySetElementType);
                    if ($isBad) {
                        $errorMessage = StringConst::EdmModel_Validator_Semantic_FunctionImportEntityTypeDoesNotMatchEntitySet(
                            $functionImport->getName(),
                            $returnedEntityType->FullName(),
                            $entitySet->getName()
                        );

                        $context->AddError(
                            $functionImport->Location(),
                            EdmErrorCode::FunctionImportEntityTypeDoesNotMatchEntitySet(),
                            $errorMessage
                        );
                    }
                } elseif ($functionImport->TryGetRelativeEntitySetPath($context->getModel(), $parameter, $path)) {
                    EdmUtil::checkArgumentNull($parameter, 'parameter');
                    EdmUtil::checkArgumentNull($path, 'path');
                    $relativePathType        = 0 === count($path) ? $parameter->getType() : end($path)->getType();
                    $relativePathElementType = $relativePathType->IsCollection() ?
                        $relativePathType->AsCollection()->ElementType() : $relativePathType;
                    $definition = $relativePathElementType->getDefinition();
                    $isBad = !$returnedEntityType->IsOrInheritsFrom($definition) &&
                             !$context->checkIsBad($returnedEntityType) &&
                             !$context->checkIsBad($definition);
                    if ($isBad) {
                        $context->AddError(
                            $functionImport->Location(),
                            EdmErrorCode::FunctionImportEntityTypeDoesNotMatchEntitySet(),
                            StringConst::EdmModel_Validator_Semantic_FunctionImportEntityTypeDoesNotMatchEntitySet2(
                                $functionImport->getName(),
                                $elementType->FullName()
                            )
                        );
                    }
                }

                // The case when all try gets fail is caught by the FunctionImportEntitySetExpressionIsInvalid rule.
            } elseif (!$context->checkIsBad($elementType->getDefinition())) {
                $context->AddError(
                    $functionImport->Location(),
                    EdmErrorCode::FunctionImportSpecifiesEntitySetButDoesNotReturnEntityType(),
                    StringConst::EdmModel_Validator_Semantic_FunctionImportSpecifiesEntitySetButNotEntityType(
                        $functionImport->getName()
                    )
                );
            }
        }
    }
}
