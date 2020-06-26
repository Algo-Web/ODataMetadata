<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITypeAnnotation;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\ITypeAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\StringConst;
use AlgoWeb\ODataMetadata\Structure\HashSetInternal;

/**
 * Validates that a type annotation implements its term type properly.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITypeAnnotation
 */
class TypeAnnotationAssertMatchesTermType extends TypeAnnotationRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $annotation)
    {
        assert($annotation instanceof ITypeAnnotation);
        $type = $annotation->getTerm();
        assert($type instanceof IStructuredType);

        $foundProperties = new HashSetInternal();

        foreach ($type->Properties() as  $typeProperty)
        {
            $annotationProperty = $annotation->FindPropertyBinding($typeProperty);
            if ($annotationProperty == null)
            {
                $context->AddRawError(
                    new EdmError(
                        $annotation->Location(),
                        EdmErrorCode::TypeAnnotationMissingRequiredProperty(),
                        StringConst::EdmModel_Validator_Semantic_TypeAnnotationMissingRequiredProperty(
                            $typeProperty->getName()
                        )
                    )
                );
            }
            else
            {
                $foundProperties->add($typeProperty);
            }
        }

        if (!$type->isOpen())
        {
            foreach ($annotation->getPropertyValueBindings() as $property)
            {
                if (!$foundProperties.contains($property->getBoundProperty()) && !$context->checkIsBad($property))
                {
                    $context->AddError(
                        $property->Location(),
                        EdmErrorCode::TypeAnnotationHasExtraProperties(),
                        StringConst::EdmModel_Validator_Semantic_TypeAnnotationHasExtraProperties($property->getBoundProperty()->getName()));
                }
            }
        }
    }
}