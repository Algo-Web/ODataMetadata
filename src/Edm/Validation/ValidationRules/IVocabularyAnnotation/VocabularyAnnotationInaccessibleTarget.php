<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IVocabularyAnnotation;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionBase;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that a vocabulary annotations target can be found through the model containing the annotation.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IVocabularyAnnotation
 */
class VocabularyAnnotationInaccessibleTarget extends VocabularyAnnotationRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $annotation)
    {
        assert($annotation instanceof IVocabularyAnnotation);
        $target      = $annotation->getTarget();
        $foundTarget = $this->findTarget($context, $target);

        if (!$foundTarget) {
            EdmUtil::checkArgumentNull($annotation->Location(), 'annotation->Location');
            $context->AddError(
                $annotation->Location(),
                EdmErrorCode::BadUnresolvedTarget(),
                StringConst::EdmModel_Validator_Semantic_InaccessibleTarget(EdmUtil::FullyQualifiedName($target))
            );
        }
    }

    /**
     * @param  ValidationContext                                        $context
     * @param  \AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable $target
     * @return bool
     */
    protected function findTarget(
        ValidationContext $context,
        \AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable $target
    ): bool {
        $foundTarget     = false;
        $entityContainer = $target;
        if ($entityContainer instanceof IEntityContainer) {
            $foundTarget = ($context->getModel()->findEntityContainer($entityContainer->FullName()) != null);
            return $foundTarget;
        }
        $entitySet = $target;
        if ($entitySet instanceof IEntitySet) {
            EdmUtil::checkArgumentNull($entitySet->getName(), 'entitySet->getName');
            $container = $entitySet->getContainer();
            if ($container instanceof IEntityContainer) {
                $foundTarget = ($container->findEntitySet($entitySet->getName()) != null);
                return $foundTarget;
            }
            return false;
        }
        $schemaType = $target;
        if ($schemaType instanceof ISchemaType) {
            $foundTarget = ($context->getModel()->FindType($schemaType->FullName()) != null);
            return $foundTarget;
        }
        $term = $target;
        if ($term instanceof ITerm) {
            $foundTarget = ($context->getModel()->FindValueTerm($term->FullName()) != null);
            return $foundTarget;
        }
        $function = $target;
        if ($function instanceof IFunction) {
            $foundTarget = count($context->getModel()->FindFunctions($function->FullName())) > 0;
            return $foundTarget;
        }
        $functionImport = $target;
        if ($functionImport instanceof IFunctionImport) {
            EdmUtil::checkArgumentNull($functionImport->getName(), 'functionImport->getName');
            $funcName    = $functionImport->getName();
            $foundTarget = count($functionImport->getContainer()->findFunctionImports($funcName)) > 0;
            return $foundTarget;
        }
        $typeProperty = $target;
        if ($typeProperty instanceof IProperty) {
            $declaringType = $typeProperty->getDeclaringType();
            assert($declaringType instanceof ISchemaType);
            $declaringTypeFullName = EdmUtil::FullyQualifiedName($declaringType);
            EdmUtil::checkArgumentNull($declaringTypeFullName, 'declaringTypeFullName');
            EdmUtil::checkArgumentNull($typeProperty->getName(), 'typeProperty->getName');
            $modelType = $context->getModel()->FindType($declaringTypeFullName);
            if ($modelType !== null && $modelType instanceof IStructuredType) {
                // If we can find a structured type with this name in the model check if it
                // has a property with this name
                $foundTarget = ($modelType->findProperty($typeProperty->getName()) != null);
                return $foundTarget;
            }
            return false;
        }
        $functionParameter = $target;
        if ($functionParameter instanceof IFunctionParameter) {
            $paramName = $functionParameter->getName();
            EdmUtil::checkArgumentNull($paramName, 'functionParameter->getName');
            $declaringFunction = $functionParameter->getDeclaringFunction();
            switch (true) {
                case $declaringFunction instanceof IFunction:
                    $functions = $context->getModel()->FindFunctions($declaringFunction->FullName());
                    break;
                case $declaringFunction instanceof IFunctionImport:
                    $container = $declaringFunction->getContainer();
                    assert($container instanceof IEntityContainer);
                    EdmUtil::checkArgumentNull($declaringFunction->getName(), 'declaringFunction->getName');
                    $functions = $container->findFunctionImports($declaringFunction->getName());
                    break;
                default:
                    return false;
            }

            // For all functions with this name declared in the model check if it has
            // a parameter with this name
            return 0 < count(array_filter($functions, function (IFunctionBase $func) use ($paramName) {
                return null !== $func->findParameter($paramName);
            }));
        } else {
            // Only validate annotations targeting elements that can be found via the
            // model API.
            // E.g. annotations targeting annotations will not be valid without this branch.
            $foundTarget = true;
        }
        return $foundTarget;
    }
}
