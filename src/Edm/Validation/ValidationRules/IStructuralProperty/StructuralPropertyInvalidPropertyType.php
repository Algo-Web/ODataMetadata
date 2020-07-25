<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IStructuralProperty;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
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
        if ($property->getDeclaringType()->getTypeKind()->isRow()) {
            $validatedType = $property->getType()->isCollection() ?
                $property->getType()->asCollection()->elementType()->getDefinition() :
                $property->getType()->getDefinition();

            EdmUtil::checkArgumentNull($validatedType, 'validatedType');
            if (!$validatedType->getTypeKind()->isPrimitive() &&
                !$validatedType->getTypeKind()->isEnum() &&
                !$validatedType->getTypeKind()->isComplex() &&
                !$context->checkIsBad($validatedType)) {
                EdmUtil::checkArgumentNull($property->location(), 'property->Location');
                $context->addError(
                    $property->location(),
                    EdmErrorCode::InvalidPropertyType(),
                    StringConst::EdmModel_Validator_Semantic_InvalidPropertyType(
                        $property->getType()->typeKind()->getKey()
                    )
                );
            }
        }
    }
}
