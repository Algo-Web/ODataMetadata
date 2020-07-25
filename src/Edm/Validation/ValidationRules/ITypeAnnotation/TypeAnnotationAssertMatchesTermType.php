<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ITypeAnnotation;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
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
        EdmUtil::checkArgumentNull($annotation->location(), 'annotation->Location');

        foreach ($type->properties() as $typeProperty) {
            $annotationProperty = $annotation->findPropertyBinding($typeProperty);
            if ($annotationProperty == null) {
                $context->addRawError(
                    new EdmError(
                        $annotation->location(),
                        EdmErrorCode::TypeAnnotationMissingRequiredProperty(),
                        StringConst::EdmModel_Validator_Semantic_TypeAnnotationMissingRequiredProperty(
                            $typeProperty->getName()
                        )
                    )
                );
            } else {
                $foundProperties->add($typeProperty);
            }
        }

        if (!$type->isOpen()) {
            foreach ($annotation->getPropertyValueBindings() as $property) {
                if (!$foundProperties->contains($property->getBoundProperty()) && !$context->checkIsBad($property)) {
                    EdmUtil::checkArgumentNull($property->location(), 'property->Location');
                    $context->addError(
                        $property->location(),
                        EdmErrorCode::TypeAnnotationHasExtraProperties(),
                        StringConst::EdmModel_Validator_Semantic_TypeAnnotationHasExtraProperties(
                            $property->getBoundProperty()->getName()
                        )
                    );
                }
            }
        }
    }
}
