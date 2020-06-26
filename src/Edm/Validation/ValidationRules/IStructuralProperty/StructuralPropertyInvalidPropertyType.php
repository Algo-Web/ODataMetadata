<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuralProperty;


use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that the property is of an allowed type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuralProperty
 */
class StructuralPropertyInvalidPropertyType extends StructuralPropertyRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $property)
    {
        assert($property instanceof IStructuralProperty);
        if ($property->getDeclaringType()->getTypeKind()->isRow())
        {
            $validatedType = $property->getType()->IsCollection() ?
                $property->getType()->AsCollection()->ElementType()->getDefinition()
                :
                $property->getType()->getDefinition();

            if (!$validatedType->getTypeKind()->isPrimitive() &&
                !$validatedType->getTypeKind()->isEnum() &&
                !$validatedType->getTypeKind()->isComplex() &&
                !$context->checkIsBad($validatedType))
            {
                $context->AddError(
                    $property->Location(),
                    EdmErrorCode::InvalidPropertyType(),
                    StringConst::EdmModel_Validator_Semantic_InvalidPropertyType($property->getType()->TypeKind()->getKey()));
            }
        }
    }
}