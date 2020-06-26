<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IVocabularyAnnotation;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
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
        $target = $annotation->getTarget();
        $foundTarget = false;

        $entityContainer = $target ;
        if ( $entityContainer instanceof IEntityContainer)
        {
            $foundTarget = ($context->getModel()->findEntityContainer($entityContainer->FullName()) != null);
        }
        else
        {
            $entitySet = $target ;
            if ($entitySet instanceof IEntitySet)
            {
                $container = $entitySet->getContainer();
                if ($container != null && $context instanceof IEntityContainer)
                {
                    $foundTarget = ($container->findEntitySet($entitySet->getName()) != null);
                }
            }
            else
            {
                $schemaType = $target;
                if ($schemaType != null && $schemaType instanceof ISchemaType)
                {
                    $foundTarget = ($context->getModel()->FindType($schemaType->FullName()) != null);
                }
                else
                {
                    $term = $target ;
                    if ($term != null && $term instanceof ITerm)
                    {
                        $foundTarget = ($context->getModel()->FindValueTerm($term->FullName())!= null);
                    }
                    else
                    {
                        $function = $target;
                        if ($function != null && $function instanceof IFunction)
                        {
                            $foundTarget = count($context->getModel()->FindFunctions($function->FullName())) > 0;
                        }
                        else
                        {
                            $functionImport = $target;
                            if ($functionImport != null && $functionImport instanceof IFunctionImport)
                            {
                                $foundTarget = count($functionImport->getContainer()->findFunctionImports($functionImport->getName())) > 0;
                            }
                            else
                            {
                                $typeProperty = $target;
                                if ($typeProperty != null && $typeProperty instanceof IProperty)
                                {
                                    $declaringType = $typeProperty->getDeclaringType();
                                    assert($declaringType instanceof ISchemaType);
                                    $declaringTypeFullName = EdmUtil::FullyQualifiedName($declaringType);
                                    $modelType = $context->getModel()->FindType($declaringTypeFullName);
                                    if ($modelType != null && $modelType instanceof IStructuredType)
                                    {
                                        // If we can find a structured type with this name in the model check if it has a property with this name
                                        $foundTarget = ($modelType->findProperty($typeProperty->getName()) != null);
                                    }
                                }
                                else
                                {
                                    $functionParameter = $target;
                                    if ($functionParameter != null && $functionParameter instanceof IFunctionParameter)
                                    {
                                        $declaringFunction = $functionParameter->getDeclaringFunction();
                                        if ($declaringFunction != null && $declaringFunction instanceof  IFunction)
                                        {
                                            // For all functions with this name declared in the model check if it has a parameter with this name
                                            foreach ($context->getModel()->FindFunctions($declaringFunction->FullName()) as $func)
                                            {
                                                if ($func->findParameter($functionParameter->getName()) != null)
                                                {
                                                    $foundTarget = true;
                                                    break;
                                                }
                                            }
                                        }
                                        else
                                        {
                                            $declaringFunctionImport = $functionParameter->getDeclaringFunction();
                                            if ($declaringFunctionImport != null && $declaringFunctionImport instanceof IFunctionImport)
                                            {
                                                $container = $declaringFunctionImport->getContainer();
                                                assert($container instanceof IEntityContainer);
                                                foreach ($container->findFunctionImports($declaringFunctionImport->getName()) as $currentFunction)
                                                {
                                                    if ($currentFunction->findParameter($functionParameter->getName()) != null)
                                                    {
                                                        $foundTarget = true;
                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    else
                                    {
                                        // Only validate annotations targeting elements that can be found via the model API.
                                        // E.g. annotations targeting annotations will not be valid without this branch.
                                        $foundTarget = true;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        if (!$foundTarget)
        {
            $context->AddError(
                $annotation->Location(),
                EdmErrorCode::BadUnresolvedTarget(),
                StringConst::EdmModel_Validator_Semantic_InaccessibleTarget(EdmUtil::FullyQualifiedName($target))
            );
        }
    }
}